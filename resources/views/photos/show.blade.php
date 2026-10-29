<x-custom-layout :title="$photo->title">
    <x-slot name="header">
        <a href="{{ route('photos.index') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
            &larr; {{ __('Back to photos') }}
        </a>
        <h2 class="mt-1 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $photo->title }}
        </h2>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <img src="{{ asset('storage/'.$photo->own_image_path) }}"
             alt="{{ $photo->title }}"
             class="w-full max-h-[70vh] object-contain bg-gray-200 dark:bg-gray-700">

        <div class="p-6 grid gap-6 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ $photo->location }} &middot; {{ $photo->taken_at->format('d-m-Y') }}
                </p>
                <p class="mt-4">{{ $photo->description }}</p>
            </div>

            <dl class="grid grid-cols-2 gap-x-4 gap-y-3 text-sm">
                <dt class="text-gray-500 dark:text-gray-400">{{ __('Camera') }}</dt>
                <dd>{{ $photo->camera }}</dd>

                <dt class="text-gray-500 dark:text-gray-400">{{ __('Lens') }}</dt>
                <dd>{{ $photo->lens }}</dd>

                <dt class="text-gray-500 dark:text-gray-400">{{ __('Focal length') }}</dt>
                <dd>{{ $photo->focal_length }}</dd>

                <dt class="text-gray-500 dark:text-gray-400">{{ __('Aperture') }}</dt>
                <dd>{{ $photo->aperture }}</dd>

                <dt class="text-gray-500 dark:text-gray-400">{{ __('Shutter speed') }}</dt>
                <dd>{{ $photo->shutter_speed }}</dd>

                <dt class="text-gray-500 dark:text-gray-400">{{ __('ISO') }}</dt>
                <dd>{{ $photo->iso }}</dd>
            </dl>
        </div>
    </div>
</x-custom-layout>
