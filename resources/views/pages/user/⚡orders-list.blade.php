<?php

use App\Models\Order;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

new class extends Component {
    use WithPagination;
    public $confirmingCancel = false;
    public $orderIdToCancel = null;
    public $showDetailModal = false;
    public $selectedId = null;

    #[Computed]
    public function orders()
    {
        return Order::with(['user', 'service'])
            ->latest('id')
            ->paginate(10);
    }

    public function openModal($id)
    {
        $this->selectedId = $id;
        $this->showDetailModal = true;
    }

    public function confirmCancel($orderId)
    {
        $this->orderIdToCancel = $orderId;
        $this->confirmingCancel = true;

        $this->dispatch('show-cancel-confirmation');
    }

    public function cancelOrder($orderId)
    {
        $order = Order::find($orderId);

        if (!in_array($order->status, ['pending', 'confirmed'])) {
            $this->dispatch('alert', type: 'error', message: 'این سفارش قابل لغو نیست');
            return;
        }

        $orderDateTime = Carbon::parse($order->day . ' ' . $order->time);
        $now = Carbon::now();
        $minutesDifference = $now->diffInMinutes($orderDateTime, false);

        if ($minutesDifference < 120) {
            $this->dispatch('alert', type: 'error', message: 'تا دو ساعت قبل زمان سفارش میتوانید آن را لغو کنید');
            return;
        }

        $order->update(['status' => 'canceled']);

        $this->confirmingCancel = false;
        $this->orderIdToCancel = null;

        $this->dispatch('alert', type: 'success', message: 'سفارش با موفقیت لغو شد');
    }
};
?>

<div>
    <x-modal wire:model="showDetailModal" title="مشاهده جزییات درخواست" maxWidth='xl'>
        <x-order-detail :orderId="$selectedId" userType='user' />
    </x-modal>

    <div class="flex items-center justify-between mb-6 w-full">
        <h2 class="text-lg font-bold text-gray-800">درخواست‌های من</h2>
        <span class="text-sm text-gray-400">{{ $this->orders->total() }} درخواست</span>
    </div>

    @if ($this->orders->isEmpty())
        <div class="bg-white border border-gray-200 py-16 text-center flex-1 w-full px-16">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-300 mb-4" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                <line x1="16" y1="2" x2="16" y2="6" />
                <line x1="8" y1="2" x2="8" y2="6" />
                <line x1="3" y1="10" x2="21" y2="10" />
            </svg>
            <p class="text-gray-500 text-sm">هنوز درخواستی ثبت نکرده‌اید</p>
            <a href="/" wire:navigate
                class="inline-block mt-4 text-sm text-amber-700 hover:text-amber-800 font-medium">
                ثبت درخواست جدید
            </a>
        </div>
    @else
        {{-- Desktop Table --}}
        <div class="hidden md:block bg-white border border-gray-200 overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200 bg-gray-50">
                        <th class="text-right px-5 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">#
                        </th>
                        <th class="text-right px-5 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            زمان</th>
                        <th class="text-right px-5 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            سرویس</th>
                        <th class="text-right px-5 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            نشانی</th>
                        <th class="text-right px-5 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            وضعیت</th>
                        <th class="text-left px-5 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            عملیات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($this->orders as $order)
                        <tr class="hover:bg-amber-50/40 transition-colors">
                            <td class="px-5 py-4">
                                <span class="text-xs font-mono text-gray-400">{{ $order->id }}</span>
                            </td>
                            <td class="px-5 py-4">
                                <span
                                    class="text-sm text-gray-700 whitespace-nowrap">{{ $order->date_time_jalali }}</span>
                            </td>
                            <td class="px-5 py-4">
                                <span class="text-sm font-medium text-gray-800">{{ $order->service->name }}</span>
                            </td>
                            <td class="px-5 py-4 max-w-[200px]">
                                <span class="text-sm text-gray-600 block truncate" title="{{ $order->address }}">
                                    {{ $order->address }}
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <x-partials.order-status status="{{ $order->status }}" />
                            </td>
                            <td class="px-5 py-4 text-left">
                                <button wire:click="openModal({{ $order->id }})"
                                    class="inline-flex items-center gap-1.5 text-xs text-amber-700 hover:text-amber-800 font-medium transition-colors px-3 py-1.5 rounded-xs border border-amber-200 hover:border-amber-300 hover:bg-amber-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                    جزییات
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Mobile Cards --}}
        <div class="md:hidden space-y-4">
            @foreach ($this->orders as $order)
                <div class="bg-white border border-gray-200 p-5">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-mono text-gray-400">#{{ $order->id }}</span>
                            <span class="text-xs text-gray-300">|</span>
                            <span class="text-xs text-gray-500">{{ $order->date_time_jalali }}</span>
                        </div>
                        <x-partials.order-status status="{{ $order->status }}" />
                    </div>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between items-start">
                            <span class="text-gray-500 shrink-0">سرویس</span>
                            <span class="text-gray-800 font-medium mr-4 text-left">{{ $order->service->name }}</span>
                        </div>
                        <div class="flex justify-between items-start">
                            <span class="text-gray-500 shrink-0">نشانی</span>
                            <span
                                class="text-gray-600 mr-4 text-left text-xs leading-relaxed max-w-[60%]">{{ $order->address }}</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <button wire:click="openModal({{ $order->id }})"
                            class="w-full text-center text-xs text-amber-700 hover:text-amber-800 font-medium py-2.5 transition-colors border border-amber-200 rounded-xs hover:bg-amber-50">
                            مشاهده جزییات
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if ($this->orders->hasPages())
            <div class="mt-6 flex items-center justify-between">
                <span class="text-xs text-gray-400">صفحه {{ $this->orders->currentPage() }} از
                    {{ $this->orders->lastPage() }}</span>
                <div dir="rtl" class="flex gap-1">
                    {{ $this->orders->links() }}
                </div>
            </div>
        @endif
    @endif
</div>
