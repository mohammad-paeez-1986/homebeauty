@php
    use App\Models\Order;
    if (!session()->has('orderId')) {
        abort(403);
    }
    $order = Order::find(session('orderId'));

    !$order && abort(404);
@endphp
@extends('layouts.app')
@section('title', 'صفحه اصلی')
@section('content')
    <div class="sm:min-w-lg" x-data>
        <!-- کارت تایید سفارش -->
        <div class="bg-white rounded-sm shadow-xl overflow-hidden ">

            <!-- هدر با انیمیشن موفقیت -->
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-8 text-center relative overflow-hidden">
                <!-- دایره‌های تزئینی -->
                <div class="absolute top-0 left-0 w-32 h-32 bg-white opacity-10 rounded-full -ml-16 -mt-16"></div>
                <div class="absolute bottom-0 right-0 w-24 h-24 bg-white opacity-10 rounded-full -mr-12 -mb-12"></div>

                <!-- آیکون موفقیت -->
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full mb-4 relative z-10">
                    <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                <!-- پیام موفقیت -->
                <h2 class="text-2xl font-bold text-white mb-2">سفارش با موفقیت ثبت شد!</h2>
                <p class="text-green-100 text-sm">سفارش شما تایید شده و به زودی پردازش خواهد شد</p>
            </div>

            <!-- محتوای سفارش -->
            <x-order-detail :orderId="$order->id" userType='user' successRegsitered='true'/>
        </div>

        <!-- کارت اطلاعات تماس (اضافی) -->
        <div class="mt-6 bg-white rounded-xl shadow-md p-4 text-center">
            <p class="text-xs text-gray-500">
                برای تایید سفارش با شما تماس گرفته خواهد شد
            </p>
            <div class="flex justify-center gap-4 mt-2 text-xs text-gray-400">
                <span>پشتیبانی: ۰۲۱-۱۲۳۴۵۶۷۸</span>
                <span>|</span>
                <span>ایمیل: support@example.com</span>
            </div>
        </div>
    </div>
@endsection
