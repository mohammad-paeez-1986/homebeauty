<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.admin')] class extends Component {
    //
};
?>

<div class="flex flex-col gap-4">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Users -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm">کاربران</p>
                    <h3 class="text-3xl font-bold mt-1">۲۴. ۵۰</h3>
                    <p class="text-blue-200 text-sm mt-2">+12.5% from last month</p>
                </div>
                <div class="p-3 bg-white/20 rounded-full">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Orders -->
        <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-amber-100 text-sm">سفارش ها</p>
                    <h3 class="text-3xl font-bold mt-1">854</h3>
                    <p class="text-amber-200 text-sm mt-2">+8.2% from last month</p>
                </div>
                <div class="p-3 bg-white/20 rounded-full">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Income -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm">درآمد کل</p>
                    <h3 class="text-3xl font-bold mt-1">۱۲,۴۵۰,۰۰۰</h3>
                    <p class="text-green-200 text-sm mt-2">+23.1% from last month</p>
                </div>
                <div class="p-3 bg-white/20 rounded-full">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div >
        <livewire:pages::admin.pending-orders />
    </div>
</div>
