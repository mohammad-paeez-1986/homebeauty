<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    // protected $listeners = ['user-logged' => 'userLogged'];
    public $showModal = false;
    

    // public function userLogged()
    // {
    //     $this->dispatch('alert', message:'salam');
    // }

    public function mount()
    {
        $this->user = auth()->check();
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        $this->redirect('/');
    }

    public function login() {}
};
?>

<header class="sticky top-0 z-50 bg-white border-b border-gray-200">
    <div class="container mx-auto px-4 py-3 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <a href="/" wire:navigate
                class="w-9 h-9 flex items-center justify-center text-gray-500 hover:text-amber-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                    <polyline points="9 22 9 12 15 12 15 22" />
                </svg>
            </a>

            @auth
                <a href="/my-orders"
                    class="inline-flex items-center gap-1.5 bg-amber-50 hover:bg-amber-100 active:bg-amber-200 text-gray-800 py-1.5 px-4 border border-amber-200 text-sm transition-colors duration-200 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                        <line x1="16" y1="2" x2="16" y2="6" />
                        <line x1="8" y1="2" x2="8" y2="6" />
                        <line x1="3" y1="10" x2="21" y2="10" />
                    </svg>
                    سفارش های من
                </a>
                <button wire:click="logout"
                    class="w-9 h-9 flex items-center justify-center text-gray-400 hover:text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        <polyline points="16 17 21 12 16 7" />
                        <line x1="21" y1="12" x2="9" y2="12" />
                    </svg>
                </button>
            @else
                <livewire:login-register />
            @endauth
        </div>

        <div class="flex items-center gap-3">
            <a href="tel:02133444301"
                class="inline-flex items-center gap-2 max-sm:!hidden  bg-amber-50 hover:bg-amber-100 active:bg-amber-200 text-gray-800 py-1.5 px-4 border border-amber-200 text-sm font-medium ltr">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path
                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                </svg>
                <span dir="ltr">۰۲۱-۳۳۴۴۴۳۰۱</span>
            </a>
            <a href="/" class="flex items-center gap-2.5">
                <div class="w-8 h-8 bg-amber-700 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path
                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                    </svg>
                </div>
                <div class="flex flex-col leading-tight">
                    <span class="font-bold text-gray-800 text-sm tracking-tight">شبرنگ</span>
                    <span class="text-[10px] text-amber-700 font-medium">آرایشگر در محل</span>
                </div>
            </a>
        </div>
</header>
