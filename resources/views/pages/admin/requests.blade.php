<?php

use App\Models\Order;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;
    public $confirmingCancel = false;
    public $orderIdToCancel = null;
    public $showModal = true;
    public $selectedId = null;

    public function updateName()
    {
        $this->name = "mona";
    }
    #[Computed]
    public function orders()
    {
        return Order::latest('id')->paginate(10);
    }
    public function openModal($selectedId)
    {
        $this->showModal = true;
        $this->selectedId = $selectedId;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function confirmCancel($orderId)
    {
        $this->orderIdToCancel = $orderId;
        $this->confirmingCancel = true;

        // Dispatch browser event for SweetAlert or custom modal
        $this->dispatch('show-cancel-confirmation');
    }

    public function cancelOrder($orderId)
    {
        $order = Order::find($orderId);
        // Check if order can be cancelled
        if (!in_array($order->status, ['pending', 'confirmed'])) {
            $this->dispatch('alert', type: 'error', message: 'این سفارش قابل لغو نیست');
            return;
        }

        // Update status
        $order->update(['status' => 'canceled']);

        // Reset properties
        $this->confirmingCancel = false;
        $this->orderIdToCancel = null;

        // Refresh pagination
        // $this->resetPage();

        // Show success message
        $this->dispatch('alert', type: 'success', message: 'سفارش با موفقیت لغو شد');
    }
};
?>

<div class="my-10">
    <x-modal wire:model="selectedId" title="مشاهده جزییات درخواست" maxWidth='xl'>
        <x-order-detail :orderId="$selectedId" />  
    </x-modal>

    <!-- Orders Table -->
    <div class="bg-white rounded-md shadow ">
        <table
            class="min-w-full divide-y divide-gray-200 [&_th]:text-center [&_td]:text-sm [&_th]:!text-[14px] [&_th]:border-gray-100 [&_th]:border [&_th]:py-4">
            <thead class="bg-white px-9 ">
                <tr>
                    <th class=" font-normal text-gray-600 ">شناسه</th>
                    <th class=" font-normal text-gray-600 ">مشتری</th>
                    <th class=" font-normal text-gray-600 ">موبایل</th>
                    <th class=" font-normal text-gray-600 ">سرویس</th>
                    <th class=" font-normal text-gray-600 ">روز</th>
                    <th class=" font-normal text-gray-600 ">ساعت</th>
                    <th class=" font-normal text-gray-600 ">وضعیت</th>

                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">مشاهده جزییات</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($this->orders as $order)
                <tr>
                    <td class="px-6 py-4">
                        <div class="text-sm  text-gray-600"># {{ $order->id }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm  text-gray-900">{{ $order->user->name }}</div>
                    </td>
                    <td class="px-6 py-4">

                        <div class="text-xs text-gray-500">{{ $order->user->mobile }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        {{ $order->service?->name ?? '---' }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        {{ $order->jalali_day }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        {{ $order->time->format('H:i') }}
                    </td>
                    <td class="px-6 py-4 [&_div]:rounded-sm [&_div]:p-1 [&_div]:min-w-[100px] [&_div]:text-center ">
                        {{-- @include('partials.order-status', ['status' => $order->status]) --}}
                        <x-partials.order-status status="{{$order->status}}"/>
                    </td>
                    <td class="text-center">
                        <button wire:click='openModal({{$order->id}})'>مشاهده</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="px-6 py-4 bg-gray-50 shadow-none">
            <div dir="rtl" class="[&_nav]:flex [&_nav]:justify-end [&_ul]:flex [&_ul]:gap-1 [&_li]:inline-block">
                {{ $this->orders->links() }}
            </div>
        </div>
    </div>

</div>


<!-- Add to your layout -->