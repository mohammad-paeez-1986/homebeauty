@php
    use App\Models\Order;
    $order = Order::find($orderId);
@endphp

@if (!$order)
    <div class="text-xs text-center p-4">
        جزییات سفارش موجود نیست
    </div>
@else
    <div class="px-2">
        <!-- اطلاعات مشتری -->
        <div class="pt-2 mb-2  pb-2">
            {{-- <h3 class="text-sm  text-gray-700 uppercase tracking-wider mb-3 flex items-center">
                    <svg class="w-4 h-4 ml-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    اطلاعات مشتری
                </h3> --}}
            <div class="bg-mist-50 rounded-sm p-4 space-y-1 border-gray-100 border flex flex-col gap-3">
                {{-- <div class="flex gap-2  items-center">
                        <span class="text-xs text-gray-600">نام کامل:</span>
                        <span class="text-xs  text-black">{{ $order->user?->name ?? '---' }}</span>
                    </div> --}}
                <div class="flex gap-2  items-center">
                    <span class="text-xs text-gray-600">شماره موبایل:</span>
                    <span class="text-xs  text-black">{{ $order->user?->mobile ?? '---' }}</span>
                </div>
                <div class="flex gap-2  items-start">
                    <span class="text-xs text-gray-600">آدرس:</span>
                    <span class="text-xs  text-black text-left">{{ $order->address }}</span>
                </div>
                <div class="flex gap-2  items-start">
                    <span class="text-xs text-gray-600">زمان:</span>
                    <span class="text-xs  text-black text-left">{{ $order->date_time_jalali }}</span>
                </div>
                <div class="flex gap-2  items-start">
                    <span class="text-xs text-gray-600">نوع خدمت:</span>
                    <span class="text-xs  text-black text-left">{{ $order->service?->name ?? '---' }}</span>
                </div>
            </div>
        </div>

        <!-- ملاحظات اضافی -->
        @if ($order->description)
            <div class="bg-amber-50 rounded-sm p-4 space-y-1 border-gray-100 border flex flex-col gap-3">
                <div class="flex gap-2  items-start">
                    <span class="text-xs text-gray-600">ملاحظات:</span>
                    <span class="text-xs  text-black text-left">{{ $order->description }}</span>
                </div>
            </div>
        @endif

        <!-- Status Tracker Component -->
        <x-order-status :status="$order->status" />

            
        @if ($order->status !== 'canceled' && $order->status !== 'done' && $userType=='user' && !isset($successRegsitered))
            <div class="flex justify-center items-center  w-full mb-4 gap-2 flex-col pt-5">
                <button wire:confirm="آیا از لغو این سفارش مطمئن هستید؟" wire:click="cancelOrder({{ $order->id }})"
                    class="px-4 py-2  border border-gray-300 rounded-sm hover:bg-red-500 hover:text-white transition duration-200 text-xs ">
                    لغو کردن
                </button>


            </div>
        @endif

        @if (isset($successRegsitered))
            <div class="flex justify-center items-center  w-full mb-4 gap-2 flex-col pt-5">
            <span class="text-xs text-gray-500">تا دو ساعت قبل سفارش میتوانید سفارش را لغو کنید</span><br>
            <a class="inline-flex items-center gap-1.5 bg-amber-50 hover:bg-amber-100 active:bg-amber-200 text-gray-800 py-1.5 px-4 border border-amber-200 text-sm transition-colors duration-200 cursor-pointer"
                href="{{ route('my-orders') }}">لیست سفارش ها من</a>
                </div>
    </div>
@endif

</div>
{{ $userType == 'admin' ? $footers : '' }}
@endif
