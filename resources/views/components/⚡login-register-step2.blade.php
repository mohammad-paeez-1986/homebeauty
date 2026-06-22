<?php

use App\Models\Order;
use App\Models\SmsCode;
use App\Models\User;
use App\services\AuthService;
use App\services\SmsService;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Modelable;
use Livewire\Component;

new class extends Component {
    #[Modelable]
    public $mobile;
    public $code;
    public $userExists = false;
    public $isCodeSent = false;
    public $availableIn = 10;
    public $actionTitle;
    public $userIsActive = true;
    public ?int $smsCodeId = null;
    public bool $isOrderProcess = false;

    protected function rules()
    {
        return ['code' => 'required|digits:4'];
    }

    protected function messages()
    {
        return [
            'code.required' => 'کد ارسال شده به موبایل را وارد نمایید',
            'code.digits' => 'کد ارسال شده باید چهار رقم باشد ',
        ];
    }

    protected function sendCode()
    {
        // $mobileKey = 'sms:mobile:' . $this->mobile;
        $this->availableIn = 10;
        $ipKey = 'sms:ip:' . request()->ip();

        // if (RateLimiter::tooManyAttempts($mobileKey, 1)) {
        //     $seconds = RateLimiter::availableIn($mobileKey);
        //     $this->availableIn = $seconds;
        //     $this->dispatch('alert', type: 'error', message: "لطفاً {$seconds} ثانیه دیگر تلاش کنید");
        //     return;
        // }

        if (RateLimiter::tooManyAttempts($ipKey, 1)) {
            $seconds = RateLimiter::availableIn($ipKey);
            $this->availableIn = $seconds;
            $this->dispatch('alert', type: 'error', message: "لطفاً {$seconds} ثانیه دیگر تلاش کنید");
            return;
        }

        // RateLimiter::hit($mobileKey, 10);
        RateLimiter::hit($ipKey, 10);

        try {
            $smsCode = SmsCode::generate($this->mobile);
            SmsService::send($smsCode->code, $smsCode->mobile);
            $this->smsCodeId = $smsCode->id;
            $this->isCodeSent = true;
            $this->dispatch('alert', type: 'success', message: 'کد تایید به موبایل شما ارسال شد');
        } catch (\Throwable $e) {
            dd($e->getMessage());
            $this->dispatch('alert', type: 'error', message: 'مشکل در ارسال کد تایید لطفا کمی بعد تلاش کنید یا لطفا با پشتیبانی تماس بگیرید');
        }
    }

    public function mount()
    {
        $user = User::where('mobile', $this->mobile)->first();

        if ($user && !$user->is_active) {
            $this->userIsActive = false;
            return false;
        }

        if (!$user) {
            $this->userExists = false;
            $this->sendCode();
            return;
        }

        $this->userExists = false;
        $this->sendCode();
    }

    public function resend()
    {
        $this->resetErrorBag('code');
        $this->sendCode();
    }

    public function submit()
    {
        $this->resetErrorBag();
        $this->validate();
        $smsCode = Smscode::findorFail($this->smsCodeId);
        if ($smsCode->checkCode($this->code)) {
            if (!auth()->check()) {
                if ($this->isOrderProcess) {
                    $this->dispatch('auth-validated');
                } else {
                    $userId = AuthService::registerOrLogin($this->mobile);
                    session()->flash('message', 'شما با موفقیت وارد شدید');
                    $this->redirect(request()->header('Referer', '/'), navigate: false);
                }
            }
        } else {
            $this->dispatch('alert', type: 'error', message: 'کد ارسالی درست نیست');
            $smsCode->incrementAttempts();
        }
    }
};
?>

<div>
    <div id='salam'>
        <label class="block text-gray-600 mb-2 text-right">
            <div class="flex justify-between items-center">
                <span>
                    📱 کد ارسالی را وارد کنید
                    <span class="text-red-500">*</span>
                </span>
                @if (session()->has('code-resended'))
                    <span class="text-green-800 text-xs">کد مجددا ارسال شد</span>
                @endif
            </div>
        </label>

        <div class="relative">
            <input wire:model="code" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 4)" maxlength="4"
                x-init="$nextTick(() => $el.focus())"
                class="w-full ltr px-4 py-2 pr-10 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('code')
border-red-500
@enderror">
        </div>

        <div class="flex justify-between mt-2" x-data="{
            seconds: @entangle('availableIn'),
            display: '',
            showResend: false,
            interval: null,
            init() {
                this.start();
                this.$watch('seconds', (value, oldValue) => {
                    if (value > 0 && value !== oldValue) {
                        this.start();
                    }
                });
            },
            start() {
                if (this.interval) clearInterval(this.interval);
                this.showResend = false;
                this.update();
                this.interval = setInterval(() => {
                    this.seconds--;
                    this.update();
                    if (this.seconds <= 0) {
                        clearInterval(this.interval);
                        this.interval = null;
                        this.showResend = true;
                    }
                }, 1000);
            },
            update() {
                var m = Math.floor(this.seconds / 60);
                var s = this.seconds % 60;
                this.display = '(' + m + ':' + (s < 10 ? '0' : '') + s + ')';
            }
        }">
            <button class="text-xs text-amber-600 hover:text-amber-700 cursor-pointer"
                wire:click="$parent.changeMobileNumber()">
                تغییر شماره
            </button>

            <button wire:click="resend" :disabled="!showResend"
                :class="showResend ? 'text-amber-600 hover:text-amber-700 cursor-pointer' :
                    'text-gray-400 cursor-not-allowed'"
                class="text-xs">
                <span>ارسال مجدد</span>
                <span x-show="!showResend" class="ltr" x-text="display"></span>
            </button>
        </div>
        @error('code')
            <p class="text-red-500 text-sm mt-1 text-right livewire-error">{{ $message }}</p>
        @enderror


        {{-- submit buttom --}}
        <div class="pt-4 mt-4">
            <button wire:click="submit"
                class="w-full inline-flex items-center justify-center gap-2 text-white border border-amber-700 font-bold py-2.5 px-3 bg-amber-700 cursor-pointer text-sm">
                <span class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                        <polyline points="10 17 15 12 10 7" />
                        <line x1="15" y1="12" x2="3" y2="12" />
                    </svg>
                    {{ $actionTitle }}
                </span>
            </button>
        </div>
    </div>

    {{-- if mobile is inactive --}}
    <div class="flex flex-col gap-4 w-full items-center" wire:show='!userIsActive' x-clock>
        <p class="text-red-500 text-sm text-center livewire-error mt-6">حساب کاربری شما غیر
            فعال
            است لطفا با پشتیبانی تماس بگیرید.
        </p>
        <button class="text-xs text-mist-900  border border-amber-300 bg-amber-50 cursor-pointer px-3 py-2"
            wire:click="$parent.changeMobileNumber()">بازگشت</button>
    </div>
</div>
