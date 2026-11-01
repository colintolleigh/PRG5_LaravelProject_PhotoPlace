<?php

use App\Models\Category;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->withoutVite();
});

test('index shows every photo with a link to its detail page', function () {
    $photos = Photo::factory()->count(3)->create();

    $response = $this->get(route('photos.index'));

    $response->assertOk();

    foreach ($photos as $photo) {
        $response->assertSee($photo->title)
            ->assertSee($photo->location)
            ->assertSee(route('photos.show', $photo));
    }
});

test('show displays the details of a single photo', function () {
    $photo = Photo::factory()->create();

    $this->get(route('photos.show', $photo))
        ->assertOk()
        ->assertSee($photo->title)
        ->assertSee($photo->description)
        ->assertSee($photo->camera);
});

test('show returns 404 for a photo that does not exist', function () {
    $this->get(route('photos.show', 999))->assertNotFound();
});

test('hidden photos are not shown on the index', function () {
    $hidden = Photo::factory()->hidden()->create();

    $this->get(route('photos.index'))
        ->assertOk()
        ->assertDontSee($hidden->title);
});

test('hidden photos can only be viewed by their owner', function () {
    $hidden = Photo::factory()->hidden()->create();

    $this->get(route('photos.show', $hidden))->assertNotFound();

    $this->actingAs($hidden->user)
        ->get(route('photos.show', $hidden))
        ->assertOk();
});

test('guests are redirected to login when visiting the create page', function () {
    $this->get(route('photos.create'))->assertRedirect(route('login'));
});

test('guests cannot store a photo', function () {
    $this->post(route('photos.store'), ['title' => 'Nope'])->assertRedirect(route('login'));

    expect(Photo::count())->toBe(0);
});

test('logged in users can see the create page', function () {
    Category::factory()->create(['name' => 'Street']);

    $this->actingAs(User::factory()->create())
        ->get(route('photos.create'))
        ->assertOk()
        ->assertSee('Street');
});

test('logged in users can upload a photo', function () {
    Storage::fake('public');
    $user = User::factory()->create();
    $categories = Category::factory()->count(2)->create();

    $response = $this->actingAs($user)->post(route('photos.store'), [
        'title' => 'Golden Hour in Kyoto',
        'description' => 'Warm light on a quiet street.',
        'image' => UploadedFile::fake()->image('kyoto.jpg'),
        'location' => 'Kyoto, Japan',
        'camera' => 'Fujifilm X-E5',
        'lens' => 'XF 35mm F2 R WR',
        'focal_length' => '35mm',
        'aperture' => 'f/2',
        'shutter_speed' => '1/250',
        'iso' => 200,
        'taken_at' => '2026-04-12',
        'is_visible' => '1',
        'categories' => $categories->pluck('id')->all(),
    ]);

    $photo = Photo::firstOrFail();

    $response->assertRedirect(route('photos.show', $photo));

    expect($photo->user->is($user))->toBeTrue()
        ->and($photo->title)->toBe('Golden Hour in Kyoto')
        ->and($photo->iso)->toBe(200)
        ->and($photo->taken_at->toDateString())->toBe('2026-04-12')
        ->and($photo->is_visible)->toBeTrue()
        ->and($photo->categories)->toHaveCount(2);

    Storage::disk('public')->assertExists($photo->image_path);
});

test('only the title and image are required to upload a photo', function () {
    Storage::fake('public');

    $this->actingAs(User::factory()->create())->post(route('photos.store'), [
        'title' => 'Minimal',
        'image' => UploadedFile::fake()->image('minimal.jpg'),
    ])->assertSessionHasNoErrors();

    $photo = Photo::firstOrFail();

    expect($photo->is_visible)->toBeFalse()
        ->and($photo->location)->toBeNull();
});

test('uploading a photo validates the input', function () {
    Storage::fake('public');

    $this->actingAs(User::factory()->create())->post(route('photos.store'), [
        'title' => '',
        'image' => UploadedFile::fake()->create('document.pdf', 100, 'application/pdf'),
        'iso' => 'abc',
        'taken_at' => now()->addDay()->toDateString(),
        'categories' => [999],
    ])->assertSessionHasErrors(['title', 'image', 'iso', 'taken_at', 'categories.0']);

    expect(Photo::count())->toBe(0);
});

test('guests are redirected to login when visiting my photos', function () {
    $this->get(route('photos.mine'))->assertRedirect(route('login'));
});

test('my photos only shows the photos of the logged in user, including hidden ones', function () {
    $user = User::factory()->create();
    $visible = Photo::factory()->for($user)->create();
    $hidden = Photo::factory()->for($user)->hidden()->create();
    $someoneElses = Photo::factory()->create();

    $this->actingAs($user)
        ->get(route('photos.mine'))
        ->assertOk()
        ->assertSee($visible->title)
        ->assertSee($hidden->title)
        ->assertSee(route('photos.show', $hidden))
        ->assertDontSee($someoneElses->title);
});

test('guests only see public links in the navbar', function () {
    $this->get(route('photos.index'))
        ->assertOk()
        ->assertSee(route('login'))
        ->assertDontSee(route('photos.mine'))
        ->assertDontSee(route('photos.create'));
});

test('logged in users see their own links in the navbar on every layout', function () {
    $user = User::factory()->create();

    foreach ([route('photos.index'), route('dashboard'), route('profile.edit')] as $url) {
        $this->actingAs($user)
            ->get($url)
            ->assertOk()
            ->assertSee(route('photos.mine'))
            ->assertSee(route('photos.create'))
            ->assertSee($user->username);
    }
});

test('photos up to 30 MB can be uploaded', function () {
    Storage::fake('public');

    $this->actingAs(User::factory()->create())->post(route('photos.store'), [
        'title' => 'Large photo',
        'image' => UploadedFile::fake()->image('large.jpg')->size(30 * 1024),
    ])->assertSessionHasNoErrors();

    expect(Photo::count())->toBe(1);
});

test('photos larger than 30 MB are rejected', function () {
    Storage::fake('public');

    $this->actingAs(User::factory()->create())->post(route('photos.store'), [
        'title' => 'Too large',
        'image' => UploadedFile::fake()->image('too-large.jpg')->size(30 * 1024 + 1),
    ])->assertSessionHasErrors('image');

    expect(Photo::count())->toBe(0);
});
