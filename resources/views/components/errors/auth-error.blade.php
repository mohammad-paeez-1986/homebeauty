@extends('layouts.app')
@section('title', 'صفحه اصلی')
@section('content')
<div class="  flex items-center justify-center px-4 mt-10">
    <div class="max-w-lg w-full">
        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
            <!-- Icon -->
            <div class="mx-auto w-20 h-20 bg-amber-100 rounded-full flex items-center justify-center mb-6">
                <svg class="w-10 h-10 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            
            <!-- Text -->
            <h3 class="text-xl font-bold text-gray-900 mb-2">شما وارد نشده اید</h3>
            <p class="text-gray-600 mb-6">
                برای دسترسی به این صفحه باید ابتدا وارد شوید
            </p>
            
            
        </div>
        
    </div>
</div>
@endsection