<x-custom-layout title="My photos">
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('My photos') }}
            </h2>

            <a href="{{ route('photos.create') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white transition ease-in-out duration-150">
                {{ __('New photo') }}
            </a>
        </div>
    </x-slot>

    @if ($photos->isEmpty())
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 text-center">
            <p class="text-gray-500 dark:text-gray-400">{{ __("You haven't uploaded any photos yet.") }}</p>
            <a href="{{ route('photos.create') }}" class="mt-2 inline-block text-indigo-600 dark:text-indigo-400 hover:underline">
                {{ __('Upload your first photo') }}
            </a>
        </div>
    @else
        <p class="mb-6 text-sm text-gray-500 dark:text-gray-400">
            {{ trans_choice(':count photo|:count photos', $photos->count()) }}
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($photos as $photo)
                <x-photo-tile :photo="$photo" />
            @endforeach
        </div>
    @endif
</x-custom-layout>
