<?php

use App\Models\Service;
use Livewire\Attributes\Modelable;
use Livewire\Component;

new class extends Component {
    public $serviceTypes = [];
    public $statuses = [
        'pending' => 'در انتظار',
        'confirmed' => 'تایید شده',
        'canceled' => 'لغو شده',
        'completed' => 'تکمیل شده',
    ];
    public $showModal = false;
    #[Modelable]
    public $filters = [];

    public $name;
    public $mobile;
    public $serviceId;
    public $status;

    public function mount()
    {
        $this->serviceTypes = Service::orderBy('position')->pluck('name', 'id')->toArray();
    }

    public function submit()
    {
        $this->filters = $this->only(['name', 'mobile', 'serviceId', 'status']);
        $this->closeModal();
    }

    public function resetFilters()
    {
        $this->reset(['name', 'mobile', 'serviceId', 'status']);
        $this->filters = [];
        $this->closeModal();
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
};
?>
<div>
    <x-modal wire:model="showModal" title="فیلتر" maxWidth='sm'>
        <div class="p-3 text-xs">
            <div class="flex flex-col gap-4">
                <!-- Name Search -->
                {{-- <div>
                    <label class="block text-sm text-gray-600 mb-1">
                        <input wire:model="name" type="text" placeholder="نام مشتری"
                            class="w-full border border-gray-300 rounded-xs px-3 py-2 text-sm ">
                    </label>
                </div> --}}

                <!-- Mobile Search -->
                <div>
                    <label class="block text-sm text-gray-600 mb-1">
                        <input wire:model="mobile" type="text" placeholder="موبایل"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11)"
                            class="w-full border border-gray-300 rounded-xs px-3 py-2 text-sm ltr ">
                    </label>
                </div>

                <!-- Service Type -->
                <div>
                    <select wire:model="serviceId" class="w-full border border-gray-300 rounded-xs text-sm py-2 ">
                        <option value="">همه سرویس‌ها</option>
                        @foreach ($serviceTypes as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Status -->
                <div>
                    <select wire:model="status" class="w-full border border-gray-300 rounded-xs px-3 py-2 text-sm ">
                        <option value="">همه وضعیت‌ها</option>
                        @foreach ($statuses as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Filter Actions -->
            <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-100">
                <button wire:click="submit"
                    class="px-4 py-2 text-sm text-gray-100 bg-green-600 rounded-xs hover:bg-green-400 transition-colors">
                    اعمال فیلتر
                </button>

                <button wire:click="resetFilters"
                    class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-xs hover:bg-gray-200 transition-colors">
                    حذف فیلترها
                </button>
            </div>
        </div>
    </x-modal>
    <div class="flex">
        <button wire:click="openModal"
            class="px-4 py-2 text-xs  bg-white border  hover:bg-gray-100 hover:text-red-700 
        {{ !empty(array_filter($this->filters)) ? 'border-amber-600 text-red-700' : 'border-gray-200 text-gray-900' }}">
            <div class="flex gap-2">
                <span>فیلتر </span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
            </div>
        </button>
        @if (!empty(array_filter($this->filters)))
            <button wire:click="resetFilters"
                class="px-4 py-2 text-xs text-gray-900 bg-white border border-r-0  hover:bg-gray-100 hover:text-red-700 border-gray-200">
                x
            </button>
        @endif
    </div>
</div>
