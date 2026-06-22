<?php

use Livewire\Component;
use Livewire\Attributes\Modelable;

new class extends Component {
    public $code;
};
?>

<div x-data="{
    showError: true,
    seconds: 3,
    display: '3',
    showResend: false,
    interval: null,
    init() {
        this.start();
    },
    start() {
        this.seconds = 3;
        this.showResend = false;
        this.update();
        if (this.interval) clearInterval(this.interval);
        this.interval = setInterval(() => {
            this.seconds--;
            this.update();
            if (this.seconds <= 0) {
                clearInterval(this.interval);
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
        <input wire:model="code" maxlength="4"
            class="w-full ltr px-4 py-2 pr-10 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('mobile') border-red-500 @enderror">
    </div>

    <div class="flex justify-between mt-2">
        <button class="text-xs text-amber-600 hover:text-amber-700 cursor-pointer" wire:click="$parent.changeMobileNumber()">
            تغییر شماره
        </button>

        <button wire:click="$parent.sendCode()"
            :disabled="!showResend"
            :class="showResend ? 'text-amber-600 hover:text-amber-700 cursor-pointer' : 'text-gray-400 cursor-not-allowed'"
            class="text-xs">
            <span>ارسال مجدد</span>
            <span x-show="!showResend" class="ltr" x-text="display"></span>
        </button>
    </div>
</div>
