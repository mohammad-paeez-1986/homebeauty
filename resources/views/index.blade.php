@extends('layouts.app')
@section('title', 'آرایشگر در منزل شبرنگ در تهران')
@push('meta')
    <meta name="description" content=" بهترین آرایشگر در منزل تهران با شبرنگ. خدمات کوتاهی و اصلاح مو برای کودکان، سالمندان و مردان در محل. ثبت سفارش سریع، قیمت منصفانه و بهداشت کامل.">
@endpush
@section('hero')
    <section class="relative overflow-hidden min-h-[420px] md:min-h-[500px] flex items-center border-b border-amber-200"
        style="background:#3d1b0b">
        <div class="absolute inset-0">
            <img src="{{ asset('images/photo-1560066984-138dadb4c035.jpeg') }}" alt="آرایشگر و اصلاح در منزل در تهران"
                class="w-full h-full object-cover" onerror="this.style.display='none'">
            <div class="absolute inset-0 bg-gradient-to-l from-amber-900/90 via-amber-800/80 to-amber-950/90"></div>
        </div>
        
        <div class="relative px-6 py-16 md:py-24 md:px-10 text-center text-white w-full">
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-4">
                آرایشگر در محل و منزل در تهران و حومه
            </h1>
            
            <p class="text-lg md:text-xl text-white/80 max-w-lg mx-auto mb-8">
                هر مدل مو، هر زمان، هر کجا. بهترین آرایشگران تهران را درب منزل خود تجربه کنید.
            </p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center max-w-2xl mx-auto">
                <a href="#booking"
                    class="flex-1 inline-flex items-center justify-center gap-2 bg-white text-amber-800 font-bold py-5 px-12 text-lg border-2 border-white hover:bg-amber-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="6" cy="6" r="3" />
                        <circle cx="18" cy="18" r="3" />
                        <path d="M8.5 8.5 12 12l3.5-3.5" />
                        <path d="M12 12v9" />
                        <path d="M12 3v9" />
                    </svg>
                    رزرو آنلاین و سریع
                </a>
                <a href="#how-it-works"
                    class="flex-1 inline-flex items-center justify-center gap-2 text-white font-semibold py-5 px-12 text-lg border-2 border-white/50 hover:bg-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 16v-4" />
                        <path d="M12 8h.01" />
                    </svg>
                    نحوه کار
                </a>
            </div>
            
        </div>
    </section>
@endsection
@section('content')
    <div class="w-full max-w-3xl">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 mb-16 mt-5">

            <!-- Service 1: Children -->
            <div class="service-card bg-white rounded-sm shadow-lg overflow-hidden border border-amber-100">
                <div class="bg-gradient-to-br from-amber-500 to-amber-600 p-6 text-white text-center">
                    <span class="text-5xl block">🧒</span>
                    <h3 class="text-md font-bold mt-2">آرایش و اصلاح موی کودک</h3>
                    <p class="text-amber-100 text-sm">در منزل در تهران</p>
                </div>
                <div class="px-2 py-6">
                    <ul class="space-y-3 text-gray-700 text-sm">
                        <li class="flex items-start gap-2">
                            <span class="text-amber-500">✓</span>
                            <span>آرایشگران با تجربه در کار با کودکان</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-amber-500">✓</span>
                            <span>استفاده از لوازم ضد حساسیت و استریل</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-amber-500">✓</span>
                            <span>محیط آرام و دوستانه در منزل شما</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-amber-500">✓</span>
                            <span>مدل‌های متناسب با سن و سلیقه کودک</span>
                        </li>
                    </ul>
                    
                </div>
            </div>

            <!-- Service 2: Elderly -->
            <div class="service-card bg-white rounded-sm shadow-lg overflow-hidden border border-amber-100">
                <div class="bg-gradient-to-br from-amber-600 to-amber-700 p-6 text-white text-center">
                    <span class="text-5xl block">👴</span>
                    <h3 class="text-md font-bold mt-2">آرایش و اصلاح موی سر و صورت  سالمندان و افراد مسن</h3>
                    <p class="text-amber-100 text-sm">در منزل در تهران</p>
                </div>
                <div class="py-6 px-2">
                    <ul class="space-y-3 text-gray-700 text-sm">
                        <li class="flex items-start gap-2">
                            <span class="text-amber-500">✓</span>
                            <span>آرایشگران با صبر و حوصله‌ی بالا</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-amber-500">✓</span>
                            <span>امکان انجام خدمات در حالت نشسته یا خوابیده</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-amber-500">✓</span>
                            <span>استفاده از ملایم‌ترین ابزار و محصولات</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-amber-500">✓</span>
                            <span>رفع نیاز بدون نیاز به جابجایی سالمند</span>
                        </li>
                    </ul>
                    
                </div>
            </div>

            <!-- Service 3: Men -->
            <div class="service-card bg-white rounded-sm shadow-lg overflow-hidden border border-amber-100">
                <div class="bg-gradient-to-br from-amber-700 to-amber-800 p-6 text-white text-center">
                    <span class="text-5xl block">👨</span>
                    <h3 class="text-md font-bold mt-2">آرایش و اصلاح موی مردان</h3>
                    <p class="text-amber-100 text-sm">در منزل در تهران</p>
                </div>
                <div class="py-6 px-2">
                    <ul class="space-y-3 text-gray-700 text-sm">
                        <li class="flex items-start gap-2">
                            <span class="text-amber-500">✓</span>
                            <span>کوتاهی و اصلاح حرفه‌ای با جدیدترین تکنیک‌ها</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-amber-500">✓</span>
                            <span>مدل‌های کلاسیک و مدرن متناسب با چهره</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-amber-500">✓</span>
                            <span>استفاده از برندهای معتبر جهانی</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-amber-500">✓</span>
                            <span>پذیرش سفارش در تمام مناطق تهران</span>
                        </li>
                    </ul>
                    
                </div>
            </div>

        </div>
        {{-- Why Choose Us --}}
        <section class="mb-30 mt-20 ">
            <div class="text-center mb-8">
                <span class="inline-block px-4 py-1.5 bg-amber-100 text-amber-800 text-sm font-semibold mb-3">چرا
                    شبرنگ؟</span>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">چرا آرایشگر در منزل و محل در تهران؟</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4">
                <div class="bg-white p-5 md:p-6 border border-gray-200 text-center">
                    <div class="w-14 h-14 mx-auto mb-4 bg-amber-50 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-amber-700" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round">
                            <circle cx="6" cy="6" r="3" />
                            <circle cx="18" cy="18" r="3" />
                            <path d="M8.5 8.5 12 12l3.5-3.5" />
                            <path d="M12 12v9" />
                            <path d="M12 3v9" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-800 text-sm md:text-base">آرایشگران حرفه‌ای</h3>
                    <p class="text-xs text-gray-500 mt-1">مجرب و دارای بیمه</p>
                </div>
                <div class="bg-white p-5 md:p-6 border border-gray-200 text-center">
                    <div class="w-14 h-14 mx-auto mb-4 bg-amber-50 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-amber-700" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M3 10.5V21a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-5.5" />
                            <path d="M15 21v-5a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v5" />
                            <path d="M21 10.5 12 3l-9 7.5" />
                            <path d="M19 7.5V4h-2v2.5" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-800 text-sm md:text-base">انجام در منزل</h3>
                    <p class="text-xs text-gray-500 mt-1">صرفه‌جویی در وقت و ترافیک</p>
                </div>
                <div class="bg-white p-5 md:p-6 border border-gray-200 text-center">
                    <div class="w-14 h-14 mx-auto mb-4 bg-amber-50 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-amber-700" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z" />
                            <path d="M8 12h8" />
                            <path d="M12 8v8" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-800 text-sm md:text-base">بهداشت کامل</h3>
                    <p class="text-xs text-gray-500 mt-1">ابزار استریل و لوازم یکبارمصرف</p>
                </div>
                <div class="bg-white p-5 md:p-6 border border-gray-200 text-center">
                    <div class="w-14 h-14 mx-auto mb-4 bg-amber-50 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-amber-700" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="12" y1="1" x2="12" y2="23" />
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-800 text-sm md:text-base">قیمت منصفانه</h3>
                    <p class="text-xs text-gray-500 mt-1">بدون هزینه پنهان</p>
                </div>
            </div>
        </section>

        {{-- How It Works --}}

        <section id="how-it-works" class="mb-30 scroll-mt-20">
            <div class="text-center mb-8">
                <span class="inline-block px-4 py-1.5 bg-amber-100 text-amber-800 text-sm font-semibold mb-3">۳ مرحله
                    ساده</span>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">چگونه کار می‌کند</h2>
                <p class="text-gray-500 mt-2">در کمتر از ۲ دقیقه یک آرایشگر حرفه‌ای در محل شما</p>
            </div>
            <div class="grid md:grid-cols-3 gap-4">
                <div class="bg-white p-6 border border-gray-200 relative">
                    <div
                        class="absolute -top-3 -right-3 w-10 h-10 bg-amber-700 text-white flex items-center justify-center font-bold text-lg">
                        ۱</div>
                    <div class="mt-4">
                        <div class="w-16 h-16 mb-4 bg-amber-50 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-700" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M16 3h3a2 2 0 0 1 2 2v3" />
                                <path d="M8 21H5a2 2 0 0 1-2-2v-3" />
                                <path d="M21 8v8" />
                                <path d="M3 8v8" />
                                <path d="M16 21h3a2 2 0 0 0 2-2v-3" />
                                <path d="M8 3H5a2 2 0 0 0-2 2v3" />
                                <rect x="7" y="7" width="10" height="10" rx="1" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-800 text-lg mb-2">انتخاب سرویس و زمان</h3>
                        <p class="text-sm text-gray-500 leading-7">
                        نوع سرویس و زمان مناسبتان را انتخاب کنید    
                        </p>
                    </div>
                </div>
                <div class="bg-white p-6 border border-gray-200 relative">
                    <div
                        class="absolute -top-3 -right-3 w-10 h-10 bg-amber-700 text-white flex items-center justify-center font-bold text-lg">
                        ۲</div>
                    <div class="mt-4">
                        <div class="w-16 h-16 mb-4 bg-amber-50 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-700" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-800 text-lg mb-2">هماهنگی با آرایشگر</h3>
                        <p class="text-sm text-gray-500 leading-7">تیم ما بهترین آرایشگر نزدیک محل شما را اعزام می‌کند.</p>
                    </div>
                </div>
                <div class="bg-white p-6 border border-gray-200 relative">
                    <div
                        class="absolute -top-3 -right-3 w-10 h-10 bg-amber-700 text-white flex items-center justify-center font-bold text-lg">
                        ۳</div>
                    <div class="mt-4">
                        <div class="w-16 h-16 mb-4 bg-amber-50 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-700" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M12 2a5 5 0 0 0-5 5c0 2.5 5 8 5 8s5-5.5 5-8a5 5 0 0 0-5-5z" />
                                <circle cx="12" cy="7" r="1.5" fill="currentColor" />
                                <path d="M18 14c2.5 1.5 4 3.5 4 5 0 2.5-4.5 4-10 4S2 21.5 2 19c0-1.5 1.5-3.5 4-5" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-800 text-lg mb-2">انجام سرویس در منزل</h3>
                        <p class="text-sm text-gray-500 leading-7">در آدرس دلخواهتان، بدون دغدغه، لذت ببرید.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- <div id="salam"></div> --}}
        {{-- Booking Section --}}
        <section id="booking" class="mb-14 scroll-mt-20">
            <div
                class="relative bg-gradient-to-br from-amber-50 via-amber-100/40 to-white border-2 border-amber-200/60 rounded-3xl p-6 md:p-10 overflow-hidden shadow-2xl shadow-amber-200/40">
                <div class="absolute inset-0 pointer-events-none">
                    <div
                        class="absolute -top-32 -right-32 w-96 h-96 bg-gradient-to-br from-amber-300/40 via-amber-400/30 to-orange-300/20 rounded-full blur-3xl animate-pulse">
                    </div>
                    <div class="absolute -bottom-32 -left-32 w-[500px] h-[500px] bg-gradient-to-tr from-amber-400/30 via-orange-300/20 to-amber-200/30 rounded-full blur-3xl animate-pulse"
                        style="animation-delay: 2s;"></div>
                    <div
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-amber-200/20 rounded-full blur-3xl">
                    </div>
                    <div class="absolute top-10 right-1/4 w-48 h-48 bg-amber-300/20 rounded-full blur-2xl"></div>
                    <div class="absolute bottom-10 left-1/4 w-56 h-56 bg-amber-400/15 rounded-full blur-2xl"></div>
                </div>
                <!-- 3. Dotted pattern -->
                <div class="absolute inset-0 opacity-[0.06] pointer-events-none"
                    style="background-image: 
                radial-gradient(circle at 20px 20px, #b45309 2px, transparent 2px);
                background-size: 40px 40px;">
                </div>
                <div class="relative z-10" id='porder'>
                    <div class="text-center mb-6">
                        <span
                            class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-gradient-to-r from-amber-600 to-amber-700 text-white text-sm font-semibold mb-3 rounded-full shadow-lg shadow-amber-600/30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                <line x1="16" y1="2" x2="16" y2="6" />
                                <line x1="8" y1="2" x2="8" y2="6" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>
                            رزرو آنلاین
                        </span>
                        <h2 class="text-2xl md:text-3xl font-bold text-amber-900">سفارش خود را ثبت کنید</h2>
                        <p class="text-amber-700/80 mt-2">اطلاعات خود را وارد کنید تا آرایشگر به محل شما بیاید</p>
                    </div>
                </div>
                <livewire:pages::user.order-create />
            </div>
        </section>

        {{-- Trust Badges --}}
        <section class="mb-6">
            <div class=" border-gray-200  md:p-8">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="flex items-center gap-4 p-4 bg-gray-50 border border-gray-200">
                        <div class="w-12 h-12 bg-amber-100 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-700" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm">پرداخت امن در محل</h4>
                            <p class="text-xs text-gray-500">پس از انجام سرویس پرداخت کنید</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-4 bg-gray-50 border border-gray-200">
                        <div class="w-12 h-12 bg-amber-100 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-700" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm">پشتیبانی ۷ روز هفته</h4>
                            <p class="text-xs text-gray-500">از ۹ صبح تا ۱۰ شب</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-4 bg-gray-50 border border-gray-200">
                        <div class="w-12 h-12 bg-amber-100 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-700" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                <polyline points="22 4 12 14.01 9 11.01" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm">رضایت ۱۰۰٪ یا عودت وجه</h4>
                            <p class="text-xs text-gray-500">تضمین کیفیت خدمات</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="flex flex-wrap gap-4 items-center w-full justify-center bg-gray-50 rounded-3xl p-8">
                <a href="tel:+989125864597" 
       class="inline-flex items-center gap-2 px-4 py-2 bg-orange-800 hover:bg-orange-900 text-white font-medium rounded-lg transition duration-200">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
        </svg>
        تماس مستقیم با پشتیبانی
    </a>
                <!-- WhatsApp -->
                <a href="https://wa.me/989125864597" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-[#25D366] hover:bg-[#1da851] text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12.032 21.965c-1.821 0-3.6-.492-5.161-1.413l-5.682 1.873 1.844-5.607c-1.036-1.648-1.578-3.526-1.578-5.458 0-5.71 4.635-10.345 10.345-10.345 2.762 0 5.359 1.077 7.314 3.031 1.954 1.954 3.031 4.552 3.031 7.314 0 5.71-4.635 10.345-10.345 10.345zm0-19.131c-4.854 0-8.785 3.931-8.785 8.785 0 1.745.508 3.448 1.483 4.899l-.969 2.947 3.037-1.001c1.403.758 3.004 1.156 4.633 1.156 4.854 0 8.785-3.931 8.785-8.785 0-2.343-.911-4.55-2.564-6.203-1.653-1.653-3.859-2.564-6.203-2.564z" />
                        <path
                            d="M17.535 14.035c-.13-.089-1.079-.53-1.247-.59-.168-.06-.29-.089-.413.089s-.535.59-.656.71-.211.13-.392.04-.764-.281-1.456-.898c-.538-.481-.899-1.074-1.004-1.255-.105-.181-.011-.279.079-.369.08-.08.179-.209.269-.314.09-.105.119-.179.179-.299.06-.12.03-.224-.015-.314-.045-.09-.413-1.002-.568-1.373-.149-.357-.3-.301-.412-.306-.106-.006-.227-.007-.349-.007-.121 0-.317.045-.483.224-.166.179-.634.619-.634 1.51s.649 1.751.739 1.872c.09.121 1.267 1.947 3.069 2.726.428.185.762.296 1.022.388.429.137.819.117 1.128.071.344-.051 1.079-.441 1.232-.866.153-.425.153-.79.107-.866-.045-.075-.166-.121-.296-.21z" />
                    </svg>
                    WhatsApp
                </a>

                <!-- Telegram -->
                <a href="tg://resolve?phone=989125864597" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-[#0088cc] hover:bg-[#0077b3] text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z" />
                    </svg>
                    Telegram
                </a>
            </div>
        </section>
    </div>
@endsection
@if (session()->has('message'))
    <script>
        showToast('adasds')
    </script>
@endif
