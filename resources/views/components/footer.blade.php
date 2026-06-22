<footer class="mt-14 bg-gray-900 text-gray-400">
    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 mb-10">
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-8 h-8 bg-amber-700 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path
                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                        </svg>
                    </div>
                    <span class="font-bold text-white text-sm">Home Beauty</span>
                </div>
                <p class="text-sm text-gray-500 leading-7">
                    سامانه آنلاین رزرو آرایشگر در محل. حرفه‌ای، سریع و قابل اعتماد.
                </p>
                <div class="flex items-center gap-2 mt-4">
                    <span class="inline-block w-2 h-2 bg-green-400"></span>
                    <span class="text-xs text-green-400">آنلاین و آماده خدمت‌رسانی</span>
                </div>
            </div>

            <div>
                <h4 class="text-white font-bold mb-4 text-sm">دسترسی سریع</h4>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="#booking" class="hover:text-amber-400 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-amber-500" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M5 12h14" />
                                <path d="m12 5 7 7-7 7" />
                            </svg>
                            رزرو آنلاین
                        </a>
                    </li>
                    <li>
                        <a href="#how-it-works" class="hover:text-amber-400 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-amber-500" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M5 12h14" />
                                <path d="m12 5 7 7-7 7" />
                            </svg>
                            نحوه کار
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('my-orders') }}" class="hover:text-amber-400 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-amber-500" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M5 12h14" />
                                <path d="m12 5 7 7-7 7" />
                            </svg>
                            پیگیری درخواست
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold mb-4 text-sm">اطلاعات تماس</h4>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500 shrink-0"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                        </svg>
                        <a href="tel:02133444301">

                            <span dir="ltr">۰۲۱-۳۳۴۴۴۳۰۱</span>
                        </a>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500 shrink-0"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        <span>تهران</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500 shrink-0"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12 6 12 12 16 14" />
                        </svg>
                        <span>۹ صبح تا ۱۰ شب (۷ روز هفته)</span>
                    </li>
                </ul>
            </div>
        </div>

        <div
            class="border-t border-gray-800 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-gray-600">
            <p>© ۱۴۰۳ سامانه آرایشگر در محل | تمامی حقوق محفوظ است</p>
            <p class="flex items-center gap-1">طراحی و توسعه با
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-red-400" viewBox="0 0 24 24"
                    fill="currentColor" stroke="none">
                    <path
                        d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                </svg>
                در تهران
            </p>
        </div>
    </div>
</footer>
