<?php

namespace Tests\Feature;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Gallery;
use Tests\TestCase;

class GalleryTest extends TestCase
{
    /** @var User */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /** @test */
    public function create_gallery()
    {
        $this->actingAs($this->user)
            ->postJson(route('galleries.store'), [
                'name' => 'Lorem'
            ])
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseHas('galleries', [
            'name' => 'Lorem',
        ]);
    }

    /** @test */
    public function update_gallery()
    {
        $gallery = Gallery::factory()->create();

        $this->actingAs($this->user)
            ->putJson(route('galleries.update', $gallery->id), [
                'name' => 'Updated gallery',
            ])
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseHas('galleries', [
            'id' => $gallery->id,
            'name' => 'Updated gallery',
        ]);
    }

    /** @test */
    public function show_gallery()
    {
        $gallery = Gallery::factory()->create();

        $this->actingAs($this->user)
            ->getJson(route('galleries.show', $gallery->id))
            ->assertSuccessful()
            ->assertJson([
                'data' => [
                    'name' => $gallery->name,
                ]
            ]);
    }

    /** @test */
    public function list_gallery()
    {
        $galleries = Gallery::factory()->count(2)->create()->map(function ($gallery) {
            return $gallery->only(['id', 'name']);
        });

        $this->actingAs($this->user)
            ->getJson(route('galleries.index'))
            ->assertSuccessful()
            ->assertJson([
                 'data' => $galleries->toArray()
            ])
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name']
                ],
                'links',
                'meta'
            ]);
    }

    /** @test */
    public function delete_gallery()
    {
        $gallery = Gallery::factory()->create([
            'name' => 'Gallery for delete',
        ]);

        $this->actingAs($this->user)
            ->deleteJson(route('galleries.update', $gallery->id))
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseMissing('galleries', [
            'id' => $gallery->id,
            'name' => 'Gallery for delete',
        ]);
    }
}
