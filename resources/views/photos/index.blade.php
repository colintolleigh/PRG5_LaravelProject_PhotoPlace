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
                <a href="{{ route('photos.show', $photo) }}"
                   class="group block bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition">
                    <div class="aspect-[4/3] bg-gray-200 dark:bg-gray-700 overflow-hidden">
                        <img src="{{ asset('storage/'.$photo->own_image_path) }}"
                             alt="{{ $photo->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    </div>

                    <div class="p-4">
                        <h3 class="font-semibold text-lg">{{ $photo->title }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $photo->location }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</x-custom-layout>
