<?php

namespace Tests\Feature;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Advertisement;
use Tests\TestCase;

class AdvertisementTest extends TestCase
{
    /** @var User */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /** @test */
    public function create_advertisement()
    {
        $this->actingAs($this->user)
            ->postJson(route('advertisements.store'), [
                'name' => 'Lorem'
            ])
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseHas('advertisements', [
            'name' => 'Lorem',
        ]);
    }

    /** @test */
    public function update_advertisement()
    {
        $advertisement = Advertisement::factory()->create();

        $this->actingAs($this->user)
            ->putJson(route('advertisements.update', $advertisement->id), [
                'name' => 'Updated advertisement',
            ])
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseHas('advertisements', [
            'id' => $advertisement->id,
            'name' => 'Updated advertisement',
        ]);
    }

    /** @test */
    public function show_advertisement()
    {
        $advertisement = Advertisement::factory()->create();

        $this->actingAs($this->user)
            ->getJson(route('advertisements.show', $advertisement->id))
            ->assertSuccessful()
            ->assertJson([
                'data' => [
                    'name' => $advertisement->name,
                ]
            ]);
    }

    /** @test */
    public function list_advertisement()
    {
        $advertisements = Advertisement::factory()->count(2)->create()->map(function ($advertisement) {
            return $advertisement->only(['id', 'name']);
        });

        $this->actingAs($this->user)
            ->getJson(route('advertisements.index'))
            ->assertSuccessful()
            ->assertJson([
                 'data' => $advertisements->toArray()
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
    public function delete_advertisement()
    {
        $advertisement = Advertisement::factory()->create([
            'name' => 'Advertisement for delete',
        ]);

        $this->actingAs($this->user)
            ->deleteJson(route('advertisements.update', $advertisement->id))
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseMissing('advertisements', [
            'id' => $advertisement->id,
            'name' => 'Advertisement for delete',
        ]);
    }
}
