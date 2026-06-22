<?php

use App\Models\Admin;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use PragmaRX\Google2FA\Google2FA;

new #[Layout('layouts.simple')]  class extends Component {
    #[Title('admin login')]
    public string $mobile = '09336924836';
    public string $twoFactorCode = '';
    public $authedMobile = false;

    protected function mobileRules(): array
    {
        return [
            'mobile' => ['required', 'digits:11', 'starts_with:09'],
        ];
    }

    protected function mobileMessages(): array
    {
        return [
            'mobile.required' => 'لطفاً شماره موبایل خود را وارد کنید.',
            'mobile.digits' => 'شماره موبایل باید دقیقاً 11 رقم باشد.',
            'mobile.starts_with' => 'شماره موبایل معتبر نیست.',
            // 'mobile.in' => 'شماره موبایل مجاز نیست.',
        ];
    }

    protected function twoFactorRules(): array
    {
        return [
            'twoFactorCode' => ['required', 'digits:6'],
        ];
    }

    protected function twoFactorMessages(): array
    {
        return [
            'twoFactorCode.required' => 'لطفاً کد دو مرحله‌ای (2FA) را وارد کنید.',
            'twoFactorCode.digits' => 'کد دو مرحله‌ای باید دقیقاً 6 رقم باشد.',
        ];
    }

    public function submit(): void
    {
        if (!$this->authedMobile) {
            $this->authMobile();

            return;
        }

        $this->login();
    }

    public function authMobile(): void
    {
        $this->validate($this->mobileRules(), $this->mobileMessages());
        $admin = Admin::where(['mobile' => $this->mobile, 'is_active' => true])->first();

        if ($admin) {
            if (!$admin->is_active) {
                $this->addError('mobile', 'مدیر با این حساب مسدود است');
            } else {
                $this->authedMobile = true;
                cache()->put('secrect_key', $admin->google2fa_secret, 300);
            }
        } else {
            $this->addError('mobile', 'مدیری با این شماره ثبت نشده است');
        }

        // $this->dispatch('focus-two-factor');
    }

    public function login()
    {
        $this->validate($this->twoFactorRules(), $this->twoFactorMessages());

        $code = str_replace(' ', '', $this->twoFactorCode);
        $isValidCode = app(Google2FA::class)->verifyKey(cache()->get('secrect_key'), $code, 1);

        if (!$isValidCode) {
            throw ValidationException::withMessages([
                'twoFactorCode' => 'کد صحیح نمی باشد.',
            ]);
        }

        cache()->forget('secrect_key');

        $admin = Admin::where(['mobile' => $this->mobile, 'is_active' => true])->first();
        auth()->guard('admin')->login($admin);
        $this->dispatch('alert', message:'شما با موفقیت وارد شدید');
        return redirect()->route('admin.index');
    }
};

?>


<div class="flex justify-center items-center min-h-screen">

    <div class="bg-white rounded-sm border border-gray-100 px-10 py-14 sm:mt-10 sm:min-w-lg m-4 sm:m-0">
        <div class="text-center mb-16">
            <h2 class="text-2xl font-normal">ورود مدیر</h2>
            {{-- <p class="text-gray-600">Enter your credentials</p> --}}
        </div>

        @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
        @endif

        <form wire:submit.prevent="submit">
            <div>
                <label class="block text-gray-600  mb-2 text-right">
                    📱 شماره موبایل
                    <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input type="tel" wire:model="mobile" maxlength="11" wire:bind:disabled="authedMobile"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11)"
                        class="w-full px-4 py-2 pr-10 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent disabled:text-gray-300
                         @error('mobile') border-red-500  @enderror"
                        placeholder="09123456789">
                </div>
                @error('mobile')
                <p class="text-red-500 text-sm mt-1 text-right livewire-error">{{ $message }}</p>
                @enderror
            </div>
            <!-- 2FA -->
            <div wire:show="authedMobile" style="display:none;">
                <label class="block text-gray-600  mt-6 mb-2 text-right">
                    کد دوعاملیتی
                    <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input type="tel" wire:model="twoFactorCode" maxlength="6"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11)"
                        class="w-full px-4 py-2 pr-10 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('mobile') border-red-500  @enderror">
                </div>
                @error('twoFactorCode')
                <p class="text-red-500 text-sm mt-1 text-right livewire-error">{{ $message }}</p>
                @enderror
            </div>


            <div class="pt-8">
                <button type="submit"
                    class="w-full text-mist-900  border border-amber-300 font-bold py-3 px-6 bg-amber-50 cursor-pointer"
                    wire:loading.attr="disabled">
                    ورود
                </button>

            </div>
        </form>
    </div>

</div>