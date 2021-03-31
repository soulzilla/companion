<?php

namespace Tests\Feature;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Map;
use Tests\TestCase;

class MapTest extends TestCase
{
    /** @var User */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /** @test */
    public function create_map()
    {
        $this->actingAs($this->user)
            ->postJson(route('maps.store'), [
                'name' => 'Lorem'
            ])
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseHas('maps', [
            'name' => 'Lorem',
        ]);
    }

    /** @test */
    public function update_map()
    {
        $map = Map::factory()->create();

        $this->actingAs($this->user)
            ->putJson(route('maps.update', $map->id), [
                'name' => 'Updated map',
            ])
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseHas('maps', [
            'id' => $map->id,
            'name' => 'Updated map',
        ]);
    }

    /** @test */
    public function show_map()
    {
        $map = Map::factory()->create();

        $this->actingAs($this->user)
            ->getJson(route('maps.show', $map->id))
            ->assertSuccessful()
            ->assertJson([
                'data' => [
                    'name' => $map->name,
                ]
            ]);
    }

    /** @test */
    public function list_map()
    {
        $maps = Map::factory()->count(2)->create()->map(function ($map) {
            return $map->only(['id', 'name']);
        });

        $this->actingAs($this->user)
            ->getJson(route('maps.index'))
            ->assertSuccessful()
            ->assertJson([
                 'data' => $maps->toArray()
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
    public function delete_map()
    {
        $map = Map::factory()->create([
            'name' => 'Map for delete',
        ]);

        $this->actingAs($this->user)
            ->deleteJson(route('maps.update', $map->id))
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseMissing('maps', [
            'id' => $map->id,
            'name' => 'Map for delete',
        ]);
    }
}
