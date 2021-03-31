<?php

namespace Tests\Feature;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Advantage;
use Tests\TestCase;

class AdvantageTest extends TestCase
{
    /** @var User */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /** @test */
    public function create_advantage()
    {
        $this->actingAs($this->user)
            ->postJson(route('advantages.store'), [
                'name' => 'Lorem'
            ])
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseHas('advantages', [
            'name' => 'Lorem',
        ]);
    }

    /** @test */
    public function update_advantage()
    {
        $advantage = Advantage::factory()->create();

        $this->actingAs($this->user)
            ->putJson(route('advantages.update', $advantage->id), [
                'name' => 'Updated advantage',
            ])
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseHas('advantages', [
            'id' => $advantage->id,
            'name' => 'Updated advantage',
        ]);
    }

    /** @test */
    public function show_advantage()
    {
        $advantage = Advantage::factory()->create();

        $this->actingAs($this->user)
            ->getJson(route('advantages.show', $advantage->id))
            ->assertSuccessful()
            ->assertJson([
                'data' => [
                    'name' => $advantage->name,
                ]
            ]);
    }

    /** @test */
    public function list_advantage()
    {
        $advantages = Advantage::factory()->count(2)->create()->map(function ($advantage) {
            return $advantage->only(['id', 'name']);
        });

        $this->actingAs($this->user)
            ->getJson(route('advantages.index'))
            ->assertSuccessful()
            ->assertJson([
                 'data' => $advantages->toArray()
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
    public function delete_advantage()
    {
        $advantage = Advantage::factory()->create([
            'name' => 'Advantage for delete',
        ]);

        $this->actingAs($this->user)
            ->deleteJson(route('advantages.update', $advantage->id))
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseMissing('advantages', [
            'id' => $advantage->id,
            'name' => 'Advantage for delete',
        ]);
    }
}
