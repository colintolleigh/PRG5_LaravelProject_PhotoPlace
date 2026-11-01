<x-custom-layout title="Photos">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Photos') }}
        </h2>
    </x-slot>

    @if ($photos->isEmpty())
        <p class="text-gray-500 dark:text-gray-400">{{ __('No photos yet.') }}</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($photos as $photo)
                <x-photo-tile :photo="$photo" />
            @endforeach
        </div>
    @endif
</x-custom-layout>
