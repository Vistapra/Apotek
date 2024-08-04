@props(['label', 'value'])

<div class="flex flex-col mb-4">
    <p class="text-base text-gray-500 dark:text-gray-400">
        {{ $label }}
    </p>
    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">
        {{ $value }}
    </h3>
</div>
