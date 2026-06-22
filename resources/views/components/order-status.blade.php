<div>
    <div class="mb-8"><br>
        <div class="relative">
            <!-- Progress Line Background -->
            <div class="absolute top-5 right-0 w-full h-0.5 bg-gray-100 border-dashed rounded"></div>
            
            <div class="relative flex justify-between">

                {{-- registered --}}
                <div class="flex flex-col items-center flex-1">
                    <div class="relative z-10">
                        <div
                            class="w-10 h-10 rounded-full bg-green-400 text-white flex items-center justify-center shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-2 text-center">
                        <p class="text-xs font-bold text-green-600">ثبت شده</p>
                    </div>
                </div>

                @if ($status !== 'canceled')
                    @switch($status)
                        @case('pending')
                            <div class="flex flex-col items-center flex-1">
                                <div class="relative z-10">
                                    <div
                                        class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center shadow-lg ring-4 ring-blue-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <!-- Active Indicator Dot -->
                                    <div class="absolute -top-1 -right-1 w-3 h-3 bg-blue-500 rounded-full animate-pulse">
                                    </div>
                                </div>
                                <div class="mt-2 text-center">
                                    <p class="text-xs font-bold text-blue-600 text-center">در انتظار تایید</p>
                                </div>
                            </div>
                            <div class="flex flex-col items-center flex-1">
                                <div class="relative z-10">
                                    <div
                                        class="w-10 h-10 rounded-full bg-gray-300 text-gray-500 flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="mt-2 text-center">
                                    <p class="text-xs font-medium text-gray-500">
                                        انجام</p>
                                </div>
                            </div>
                        @break

                        @case('confirmed')
                            <div class="flex flex-col items-center flex-1">
                                <div class="relative z-10">
                                    <div
                                        class="w-10 h-10 rounded-full bg-green-400 text-white flex items-center justify-center shadow-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="mt-2 text-center">
                                    <p class="text-xs font-bold text-green-600">تایید شده</p>
                                </div>
                            </div>
                            <div class="flex flex-col items-center flex-1">
                                <div class="relative z-10">
                                    <div
                                        class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center shadow-lg ring-4 ring-blue-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <!-- Active Indicator Dot -->
                                    <div class="absolute -top-1 -right-1 w-3 h-3 bg-blue-500 rounded-full animate-pulse">
                                    </div>
                                </div>
                                <div class="mt-2 text-center">
                                    <p class="text-xs font-bold text-blue-600 text-center">در انتظار انجام</p>
                                </div>
                            </div>
                        @break

                        @case('done')
                            <div class="flex flex-col items-center flex-1">
                                <div class="relative z-10">
                                    <div
                                        class="w-10 h-10 rounded-full bg-green-400 text-white flex items-center justify-center shadow-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="mt-2 text-center">
                                    <p class="text-xs font-bold text-green-600">تایید شده</p>
                                </div>
                            </div>
                            <div class="flex flex-col items-center flex-1">
                                <div class="relative z-10">
                                    <div
                                        class="w-10 h-10 rounded-full bg-green-400 text-white flex items-center justify-center shadow-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="mt-2 text-center">
                                    <p class="text-xs font-bold text-green-600">انجام    شده</p>
                                </div>
                            </div>
                        @break
                    @endswitch
                @else
                    {{-- Canceled --}}
                    <div class="flex flex-col items-center flex-1">
                        <div class="relative z-10">
                            <div
                                class="w-10 h-10 rounded-full bg-red-700 text-gray-100 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-2 text-center">
                            <p class="text-xs font-medium text-gray-500">کنسل شده</p>
                            
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
