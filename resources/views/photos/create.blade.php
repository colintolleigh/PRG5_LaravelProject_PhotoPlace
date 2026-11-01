<x-custom-layout title="New photo">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('New photo') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
        <form method="POST" action="{{ route('photos.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Title -->
            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" name="title" type="text" class="block mt-1 w-full" :value="old('title')" required autofocus maxlength="255" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <!-- Description -->
            <div>
                <x-input-label for="description" :value="__('Description')" />
                <textarea id="description" name="description" rows="3" maxlength="255"
                          class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description') }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <!-- Image -->
            <div>
                <x-input-label for="image" :value="__('Image')" />
                <input id="image" name="image" type="file" accept="image/*" required
                       class="block mt-1 w-full text-sm text-gray-700 dark:text-gray-300 file:me-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-gray-800 file:text-white dark:file:bg-gray-200 dark:file:text-gray-800 hover:file:bg-gray-700">
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('JPG, PNG, GIF or WEBP, max 30 MB.') }}</p>
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <!-- Location -->
            <div>
                <x-input-label for="location" :value="__('Location')" />
                <x-text-input id="location" name="location" type="text" class="block mt-1 w-full" :value="old('location')" maxlength="255" placeholder="Kyoto, Japan" />
                <x-input-error :messages="$errors->get('location')" class="mt-2" />
            </div>

            <!-- Camera settings -->
            <fieldset class="grid gap-6 sm:grid-cols-2">
                <legend class="mb-4 font-semibold">{{ __('Camera settings') }}</legend>

                <div>
                    <x-input-label for="camera" :value="__('Camera')" />
                    <x-text-input id="camera" name="camera" type="text" class="block mt-1 w-full" :value="old('camera')" maxlength="255" placeholder="Fujifilm X-T5" />
                    <x-input-error :messages="$errors->get('camera')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="lens" :value="__('Lens')" />
                    <x-text-input id="lens" name="lens" type="text" class="block mt-1 w-full" :value="old('lens')" maxlength="255" placeholder="XF 23mm f/1.4" />
                    <x-input-error :messages="$errors->get('lens')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="focal_length" :value="__('Focal length')" />
                    <x-text-input id="focal_length" name="focal_length" type="text" class="block mt-1 w-full" :value="old('focal_length')" maxlength="50" placeholder="23mm" />
                    <x-input-error :messages="$errors->get('focal_length')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="aperture" :value="__('Aperture')" />
                    <x-text-input id="aperture" name="aperture" type="text" class="block mt-1 w-full" :value="old('aperture')" maxlength="50" placeholder="f/2.8" />
                    <x-input-error :messages="$errors->get('aperture')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="shutter_speed" :value="__('Shutter speed')" />
                    <x-text-input id="shutter_speed" name="shutter_speed" type="text" class="block mt-1 w-full" :value="old('shutter_speed')" maxlength="50" placeholder="1/250" />
                    <x-input-error :messages="$errors->get('shutter_speed')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="iso" :value="__('ISO')" />
                    <x-text-input id="iso" name="iso" type="number" min="1" class="block mt-1 w-full" :value="old('iso')" placeholder="200" />
                    <x-input-error :messages="$errors->get('iso')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="taken_at" :value="__('Taken on')" />
                    <x-text-input id="taken_at" name="taken_at" type="date" class="block mt-1 w-full" :value="old('taken_at')" :max="now()->toDateString()" />
                    <x-input-error :messages="$errors->get('taken_at')" class="mt-2" />
                </div>
            </fieldset>

            <!-- Categories -->
            @if ($categories->isNotEmpty())
                <fieldset>
                    <legend class="font-semibold">{{ __('Categories') }}</legend>

                    <div class="mt-3 flex flex-wrap gap-4">
                        @foreach ($categories as $category)
                            <label class="inline-flex items-center gap-2 text-sm">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                       @checked(in_array($category->id, old('categories', [])))
                                       class="rounded border-gray-300 dark:border-gray-700 dark:bg-gray-900 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800">
                                {{ $category->name }}
                            </label>
                        @endforeach
                    </div>

                    <x-input-error :messages="$errors->get('categories')" class="mt-2" />
                    <x-input-error :messages="$errors->get('categories.*')" class="mt-2" />
                </fieldset>
            @endif

            <!-- Visibility -->
            <div>
                <label class="inline-flex items-center gap-2 text-sm">
                    <input type="checkbox" name="is_visible" value="1"
                           @checked(old('is_visible', true))
                           class="rounded border-gray-300 dark:border-gray-700 dark:bg-gray-900 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800">
                    {{ __('Show this photo on the public photos page') }}
                </label>
                <x-input-error :messages="$errors->get('is_visible')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end gap-4">
                <a href="{{ route('photos.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                    {{ __('Cancel') }}
                </a>

                <x-primary-button>
                    {{ __('Upload photo') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-custom-layout>
