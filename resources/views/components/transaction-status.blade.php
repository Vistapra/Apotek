@props(['status'])

@if ($status)
    <button class="bg-green-500 text-white px-4 py-2 rounded-full hover:bg-green-600 transition-colors duration-200">
        {{ __('Sukses') }}
    </button>
@else
    <button class="bg-yellow-500 text-white px-4 py-2 rounded-full hover:bg-yellow-600 transition-colors duration-200">
        {{ __('Pending') }}
    </button>
@endif
