@props(['title' => null, 'maxWidth' => 'xl', 'closeEvent' => null])
@php
    $maxWidthClass =
        [
            'sm' => 'max-w-sm',
            'md' => 'max-w-md',
            'lg' => 'max-w-lg',
            'xl' => 'max-w-xl',
            '2xl' => 'max-w-2xl',
        ][$maxWidth] ?? 'max-w-md';
@endphp
<div>
    <div x-data="{ showModal: @entangle($attributes->wire('model')) }">
        {{ $clickable ?? '' }}
        <!-- Backdrop -->
        <div style="display: none;opacity: 0.5;" x-show="showModal" class="fixed inset-0 bg-black z-50"
            @click="showModal = false; {{ $closeEvent ? "Livewire.dispatch('{$closeEvent}')" : '' }}">
        </div>

        <!-- Modal -->
        <div style="display: none" x-show="showModal" x-transition.scale.in.duration.300
            x-transition.fade.out.duration.300 class="fixed inset-0 z-50 flex items-center justify-center p-4 "
            @click="showModal = false; {{ $closeEvent ? "Livewire.dispatch('{$closeEvent}')" : '' }}">
            <div class="bg-white rounded-sm shadow-xl w-full {{ $maxWidthClass }} " @click.stop>
                <div class="p-4 border-b border-gray-200 flex justify-between bg-gray-50 items-center">
                    <p class="font-normal text-md">{{ $title }}</p>
                    <button @click="showModal = false; {{ $closeEvent ? "Livewire.dispatch('{$closeEvent}')" : '' }}" class="text-gray-500 text-xl">&times;</button>
                </div>
                <div class="p-4">
                    {{ $slot }}
                </div>

                @if (isset($footer))
                    <div class="p-4 border-t border-gray-200 ">
                        {{ $footer }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
