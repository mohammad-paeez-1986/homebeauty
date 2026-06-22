<?php
use App\services\AuthService;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    public $mobile = '';
    public $showStep2 = false;
    public $showModal = false;

    public function mount()
    {
        if (session()->pull('google_authenticated')) {
            $this->dispatch('auth-validated');
        }
    }

    protected $rules = [
        'mobile' => 'required|regex:/^09[0-9]{9}$/|min:11|max:11',
    ];

    protected $messages = [
        'mobile.required' => 'شماره موبایل را وارد کنید',
        'mobile.regex' => 'شماره موبایل معتبر نیست',
        'mobile.min' => 'شماره موبایل باید ۱۱ رقم باشد',
    ];

    public function changeMobileNumber()
    {
        $this->number = '';
        $this->showStep2 = false;
    }

    public function submit()
    {
        $this->validate();
        $this->showStep2 = true;
    }

    #[On('reset-login-form')]
    public function onModalClose()
    {
        $this->resetErrorBag();
        $this->reset(['showStep2']);
    }
};
?>

<div>
    {{-- Login/Register Modal --}}
    <x-modal title="ورود-ثبت نام" maxWidth='xl' close-event="reset-login-form" wire:model='false'>
        <x-slot name="clickable">
            <button @click="showModal = true"
                class="inline-flex items-center gap-1.5 bg-amber-50 hover:bg-amber-100 active:bg-amber-200 text-gray-800 py-1.5 px-4 border border-amber-200 text-sm transition-colors duration-200 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                    <polyline points="10 17 15 12 10 7" />
                    <line x1="15" y1="12" x2="3" y2="12" />
                </svg>
                ورود
            </button>
        </x-slot>
        <div class="p-4 pb-5">
            @if ($showStep2)
                <livewire:login-register-step2 wire:model="mobile" :wire:key="'verify-' . $mobile"
                    action-title='تایید و ورود' />
            @else
                <div>
                    <label class="block text-gray-600  mb-2 text-right">
                        📱 شماره موبایل
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="tel" wire:model="mobile" maxlength="11"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11)"
                            class="w-full px-4 py-2 pr-10 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('mobile') border-red-500  @enderror"
                            placeholder="09123456789">
                    </div>
                    @error('mobile')
                        <p class="text-red-500 text-sm mt-1 text-right livewire-error">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Submit -->
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
                            ورود
                        </span>
                    </button>
                </div>
            @endif
        </div>
    </x-modal>
</div>
