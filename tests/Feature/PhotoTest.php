<?php

use App\Models\Photo;

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
