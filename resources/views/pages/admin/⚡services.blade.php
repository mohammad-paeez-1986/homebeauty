<?php

use App\Models\Service;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

new #[Layout('layouts.admin')] class extends Component
{
    public $showModal = false;
    public $selectedToUpdateId = null;
    public $services;

    
    public function mount()
    {
        $this->services =  Service::orderBy('position')->get();
    }

    #[On("refresh-list")]
    public function refreshList()
    {
        $this->closeModal();
        $this->services =  Service::orderBy('position')->get();
    }

    public function openModal($id = null)
    {
        $this->selectedToUpdateId = $id;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedToUpdateId = 0;
    }

    public function removeService($id)
    {
        Service::find($id)->delete();
        $this->dispatch('alert', type: 'success', message: 'خدمت با موفقیت حذف شد');
    }

    public function updateService($id)
    {
        $this->openModal($id);
    }
};
?>

<div>

    <div class="pr-4  pb-3 border-b w-full border-mist-300 flex justify-between items-center">
        <span>خدمات</span>
        <button wire:click="openModal" type="button" class="px-4 py-2 text-xs  text-gray-900 bg-white border border-gray-200  hover:bg-gray-100 hover:text-amber-700 ">
            افزودن خدمت جدید
        </button>
    </div>

    <!-- Sho services -->
    <div class="flex flex-col gap-3 mt-6">
        @foreach ($services as $service)
        <div class="text-center p-4 rounded-sm  border border-gray-200 transition-all cursor-pointer hover:border-amber-400 bg-white">
            <div class="flex justify-between text-mist-600 items-center text-xs sm:text-sm md:text-[14px] ">
                <div class=text-gray-600">{{$service->name}}</div>
                <div class="flex gap-6 items-center">
                    <div class="text-md text-amber-800">{{$service->price}} هزار تومان</div>
                    <div class="text-xs flex justify-between items-center sm:flex-row flex-col gap-2">
                        <div class="inline-flex rounded-md" role="group">
                            <button wire:click="updateService({{ $service->id }})" type="button" class="px-3 py-2 text-xs  text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-amber-700 ">
                                ویرایش
                            </button>
                            <button wire:click="removeService({{ $service->id }})" wire:confirm="آیا از حدف سرویس مطمئن هستید؟" type="button" class="px-3 py-2 text-xs  text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-red-700 ">
                                حذف
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
</div>
    <x-modal title="ثبت خدمت جدید" maxWidth='xl' wire:model="showModal">
        <livewire:admin.service-operations :service-id="$selectedToUpdateId" :key="'form-'.$selectedToUpdateId" />
    </x-modal>
</div>