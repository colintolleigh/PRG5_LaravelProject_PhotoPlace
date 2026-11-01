<x-custom-layout :title="$photo->title">
    <x-slot name="header">
        <a href="{{ route('photos.index') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
            &larr; {{ __('Back to photos') }}
        </a>
        <h2 class="mt-1 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $photo->title }}
        </h2>
    </x-slot>

    @if (session('status'))
        <div class="mb-6 rounded-md bg-green-50 dark:bg-green-900/40 p-4 text-sm text-green-800 dark:text-green-200">
            {{ session('status') }}
        </div>
    @endif

    @unless ($photo->is_visible)
        <div class="mb-6 rounded-md bg-yellow-50 dark:bg-yellow-900/40 p-4 text-sm text-yellow-800 dark:text-yellow-200">
            {{ __('This photo is hidden. Only you can see it.') }}
        </div>
    @endunless

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <img src="{{ asset('storage/'.$photo->image_path) }}"
             alt="{{ $photo->title }}"
             class="w-full max-h-[70vh] object-contain bg-gray-200 dark:bg-gray-700">

        <div class="p-6 grid gap-6 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ __('By') }} {{ $photo->user->username }}
                    @if ($photo->location)
                        &middot; {{ $photo->location }}
                    @endif
                    @if ($photo->taken_at)
                        &middot; {{ $photo->taken_at->format('d-m-Y') }}
                    @endif
                </p>

                @if ($photo->description)
                    <p class="mt-4">{{ $photo->description }}</p>
                @endif

                @if ($photo->categories->isNotEmpty())
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach ($photo->categories as $category)
                            <span class="rounded-full bg-gray-100 dark:bg-gray-700 px-3 py-1 text-xs">{{ $category->name }}</span>
                        @endforeach
                    </div>
                @endif
            </div>

            <dl class="grid grid-cols-2 gap-x-4 gap-y-3 text-sm content-start">
                @foreach ([
                    'Camera' => $photo->camera,
                    'Lens' => $photo->lens,
                    'Focal length' => $photo->focal_length,
                    'Aperture' => $photo->aperture,
                    'Shutter speed' => $photo->shutter_speed,
                    'ISO' => $photo->iso,
                ] as $label => $value)
                    @if (filled($value))
                        <dt class="text-gray-500 dark:text-gray-400">{{ __($label) }}</dt>
                        <dd>{{ $value }}</dd>
                    @endif
                @endforeach
            </dl>
        </div>
    </div>
</x-custom-layout>
