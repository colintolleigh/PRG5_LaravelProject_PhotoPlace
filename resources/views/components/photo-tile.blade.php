@props(['photo'])

<a href="{{ route('photos.show', $photo) }}"
   {{ $attributes->merge(['class' => 'group block bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition']) }}>
    <div class="relative aspect-[4/3] bg-gray-200 dark:bg-gray-700 overflow-hidden">
        <img src="{{ asset('storage/'.$photo->image_path) }}"
             alt="{{ $photo->title }}"
             class="w-full h-full object-cover group-hover:scale-105 transition duration-300">

        @unless ($photo->is_visible)
            <span class="absolute top-2 start-2 rounded-full bg-yellow-100 dark:bg-yellow-900 px-3 py-1 text-xs font-medium text-yellow-800 dark:text-yellow-200">
                {{ __('Hidden') }}
            </span>
        @endunless
    </div>

    <div class="p-4">
        <h3 class="font-semibold text-lg">{{ $photo->title }}</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $photo->location }}</p>
    </div>
</a>
