<?php

use Livewire\Component;
use Livewire\Attributes\Modelable;

new class extends Component {
    #[Modelable]
    public $mobile;
};
?>


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
