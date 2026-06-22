<?php

use App\Models\Order;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts.admin')] class extends Component {
    use WithPagination;

    public $showModal = true;
    public $selectedId = null;

    #[Computed]
    public function orders()
    {
        return Order::whereStatus('pending')->latest('id')->paginate(5);
    }
    public function openModal($selectedId)
    {
        $this->showModal = true;
        $this->selectedId = $selectedId;
    }

    public function closeModal()
    {
        $this->selectedId = null;
        $this->showModal = false;
    }

    public function confirmUpdateStatus($orderId)
    {
        $this->orderIdToCancel = $orderId;
        $this->confirmingCancel = true;

        // Dispatch browser event for SweetAlert or custom modal
        $this->dispatch('show-update-status-confirmation');
    }

    public function updateOrderStatus($status, $orderId)
    {
        $order = Order::find($orderId);

        // Check if order can be cancelled
        if (in_array($order->status, ['pending', 'confirmed', 'canceled', 'done'])) {
            $order->update(['status' => $status]);
            // Reset properties
            $this->dispatch('alert', type: 'success', message: 'سفارش با موفقیت به روز رسانی شد');
        }

        // Refresh pagination
        // $this->resetPage();
    }

    // delete order
    public function deleteOrder()
    {
        Order::find($this->selectedId)->delete();
        $this->dispatch('alert', type: 'success', message: 'سفارش با موفقیت حذف شد');

        $this->closeModal();
    }
};
?>


<div class="p-2 bg-white text-sm rounded border border-gray-300">
    <x-modal wire:model="selectedId" title="مشاهده جزییات درخواست" maxWidth='xl'>
        <x-order-detail :orderId="$selectedId" userType="simple">


        </x-order-detail>
    </x-modal>

    <div class="flex justify-between items-start">
        <h1 class="p-2 pb-6 text-sky-800">سفارشات در انتظار تایید</h1>
        <svg class="w-8 h-8" fill="none" stroke="steelblue" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10" stroke-width="2" />
            <path stroke-linecap="round" stroke-width="2" d="M12 6v6h4.5" />
        </svg>

    </div>

    <div class="flex flex-col gap-2 p-2">
        @forelse ($this->orders as $order)
            <div class="flex border   border-mauve-200 p-4 justify-between gap-6 items-center bg-gray-50 relative"
                x-transition.scale.out.duration.300 wire:key="item-{{ $order->id }}">
                <div class="text-xs">
                    @php
                        $string = $order->date_time_jalali . ' ‒ ' . ($order->service?->name ?? '') . ' ‒ ' . $order->address;
                        echo mb_substr($string, 0, 100) . (mb_strlen($string) > 100 ? '...' : '');
                    @endphp</div>

                <div>
                    <div class=" border-gray-200 text-xs flex justify-between items-center sm:flex-row flex-col gap-2">
                        <div class="inline-flex rounded-md ">
                            <button wire:click="updateOrderStatus('confirmed', {{ $order->id }})" type="button"
                                class="px-3 py-1 text-xs  text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-amber-700 ">
                                تایید
                            </button>
                            <button wire:click="updateOrderStatus('canceled', {{ $order->id }})" type="button"
                                class="px-3 py-1 text-xs  text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-amber-700  border-l">
                                لغو
                            </button>

                            <button wire:click='openModal({{ $order->id }})'
                                class="px-3 py-1 text-xs  text-gray-900 bg-white border-t border-b border rounded-l-md border-gray-200 hover:bg-gray-100 hover:text-amber-700 ">
                                مشاهده
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-4 text-gray-500">
                <svg class="w-8 h-8 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                {{-- <h3 class="text-lg font-medium text-gray-600">No Orders Yet</h3> --}}
                <p class="text-sm mt-1">سفارشی برای تایید موجود نیست</p>
            </div>
        @endforelse



    </div>
