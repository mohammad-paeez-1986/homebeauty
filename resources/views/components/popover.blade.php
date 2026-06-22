@props(['text'])

<div x-data="{ open: false }" class="relative inline-block">
    <!-- Trigger line -->
    <div @mouseenter="open = true" @mouseleave="open = false">
        {{ $slot }}
    </div>

    <!-- Popover content (opens at bottom) -->
    <div style="display: none" x-show="open" x-transition.opacity.duration.200 @mouseenter="open = true" @mouseleave="open = false"
        class="absolute z-50 bg-gray-800 text-white text-sm rounded-lg shadow-lg p-3 mt-2 whitespace-nowrap top-full left-0">
        {{ $text }}
        <!-- Arrow pointer -->
        <div class="absolute -top-1 left-4 w-2 h-2 bg-gray-800 rotate-45"></div>
    </div>
</div>
