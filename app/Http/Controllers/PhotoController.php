<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhotoRequest;
use App\Models\Category;
use App\Models\Photo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $photos = Photo::where('is_visible', true)->latest('taken_at')->get();

        return view('photos.index', compact('photos'));
    }

    /**
     * Display the photos uploaded by the logged in user, including hidden ones.
     */
    public function mine(Request $request): View
    {
        $photos = $request->user()->photos()->latest()->get();

        return view('photos.mine', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('photos.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhotoRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['image', 'categories']);
        $data['image_path'] = $request->file('image')->store('photos', 'public');

        $photo = $request->user()->photos()->create($data);
        $photo->categories()->sync($request->validated('categories', []));

        return redirect()->route('photos.show', $photo)->with('status', __('Photo uploaded.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo): View
    {
        abort_unless($photo->is_visible || $photo->user_id === auth()->id(), 404);

        $photo->load(['user', 'categories']);

        return view('photos.show', compact('photo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        //
    }
}
