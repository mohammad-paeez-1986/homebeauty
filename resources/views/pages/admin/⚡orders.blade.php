<?php

use App\Models\Order;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts.admin')] class extends Component {
    use WithPagination;

    public $selectedId = null;
    #[Modelable]
    public $filters = [];

    #[Computed]
    public function orders()
    {
        $this->resetPage();
        return Order::with(['user', 'service'])
            // ->when(!empty($this->filters['name']), fn($q) => $q->whereRelation('user', 'name', 'like', '%' . $this->filters['name'] . '%'))
            ->when(!empty($this->filters['mobile']), fn($q) => $q->whereRelation('user', 'mobile', 'like', '%' . $this->filters['mobile'] . '%'))
            ->when(!empty($this->filters['serviceId']), fn($q) => $q->where('service_id', $this->filters['serviceId']))
            ->when(!empty($this->filters['status']), fn($q) => $q->where('status', $this->filters['status']))
            ->latest('id')
            ->paginate(10);
    }
    public function openModal($selectedId)
    {
        $this->selectedId = $selectedId;
    }

    public function closeModal()
    {
        $this->selectedId = null;
    }

    public function updateOrderStatus($status)
    {
        $order = Order::find($this->selectedId);

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

    public function updatedFilters()
    {
        $this->resetPage();
    }
};
?>


<div>
    <x-modal wire:model="selectedId" title="مشاهده جزییات درخواست" maxWidth='xl' key="details">
        <x-order-detail :orderId="$selectedId" userType="admin">
            <x-slot name="footers">
                <div
                    class="pt-8 mt-5  border-gray-400 text-xs flex justify-center items-center sm:flex-row flex-col gap-2">

                    <div class="inline-flex rounded-md shadow-sm" role="group">
                        <button
                            class="px-4 py-2 text-xs  text-gray-900 bg-gray-200 border border-gray-200 rounded-r-md  "
                            disabled>
                            تغییر وضعیت سفارش:
                        </button>
                        <button wire:click="updateOrderStatus('pending')"
                            class="px-4 py-2 text-xs  text-gray-900 bg-white border border-r-0 border-gray-200 hover:bg-gray-100 hover:text-amber-700 ">
                            ثبت
                        </button>
                        <button wire:click="updateOrderStatus('confirmed')"
                            class="px-4 py-2 text-xs  text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-amber-700  border-l">
                            تایید
                        </button>
                        <button wire:click="updateOrderStatus('canceled')"
                            class="px-4 py-2 text-xs  text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-amber-700 ">
                            لغو
                        </button>
                        <button wire:click="updateOrderStatus('done')"
                            class="px-4 py-2 text-xs  text-gray-900 bg-white border border-gray-200  hover:bg-gray-100 hover:text-red-700 ">
                            انجام
                        </button>
                        <button wire:confirm="آیا از حذف این سفارش اطمینان دارید؟" wire:click="deleteOrder"
                            class="px-4 py-2 text-xs  text-gray-900 bg-white border border-r-0 border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-amber-700 ">
                            حذف سفارش
                        </button>
                    </div>
                </div>
            </x-slot>

        </x-order-detail>
    </x-modal>

    {{-- <x-modal wire:model="showModal" title="فیلتر" maxWidth='sm' key="filters">
        <livewire:admin.orders-filter wire:model.live="filters" />
        <x-slot name="clickable">
            <button
                class="px-4 py-2 text-xs  text-gray-900 bg-white border border-gray-200  hover:bg-gray-100 hover:text-red-700 ">
                فیلتر
            </button>
        </x-slot>
    </x-modal> --}}

    <!-- Orders Table -->
    <div class="pr-4  pb-3 w-full border-mist-300 flex justify-between items-center">
        <div class="flex justify-between w-full items-center">
            <span>سفارش ها</span>
            <livewire:admin.orders-filter wire:model.live="filters" />
        </div>

    </div>
    <div class="bg-white rounded-md shadow ">
        <table
            class="min-w-full divide-y divide-gray-200 [&_th]:text-center [&_td]:text-sm [&_th]:!text-[14px] [&_th]:border-gray-100 [&_th]:border [&_th]:py-4">
            <thead class="bg-white px-9 ">
                <tr>
                    <th class=" font-normal text-gray-600 ">شناسه</th>
                    <th class=" font-normal text-gray-600 ">موبایل</th>
                    <th class=" font-normal text-gray-600 ">سرویس</th>
                    <th class=" font-normal text-gray-600 ">زمان</th>
                    <th class=" font-normal text-gray-600 ">وضعیت</th>

                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">مشاهده جزییات</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($this->orders as $order)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="text-sm  text-gray-600"># {{ $order->id }}</div>
                        </td>
                    
                        <td class="px-6 py-4">
                            <div class="text-xs text-gray-500">{{ $order->user->mobile }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ $order->service?->name ?? '---' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ $order->date_time_jalali }}
                        </td>
                        
                        <td class="px-6 py-4 [&_div]:rounded-sm [&_div]:p-1 [&_div]:min-w-[100px] [&_div]:text-center ">
                            {{-- @include('partials.order-status', ['status' => $order->status]) --}}
                            <x-partials.order-status status="{{ $order->status }}" />
                        </td>
                        <td class="text-center">
                            <button wire:click='openModal({{ $order->id }})'>مشاهده</button>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="10" class="text-center">
                            <div class="text-center py-16">
                                <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                <h3 class="text-lg font-medium text-gray-500">نتیجه‌ای یافت نشد</h3>
                                <p class="text-sm text-gray-400 mt-1">موردی با این مشخصات پیدا نکردیم</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
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
