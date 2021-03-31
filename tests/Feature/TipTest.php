<?php

namespace Tests\Feature;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tip;
use Tests\TestCase;

class TipTest extends TestCase
{
    /** @var User */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /** @test */
    public function create_tip()
    {
        $this->actingAs($this->user)
            ->postJson(route('tips.store'), [
                'name' => 'Lorem'
            ])
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseHas('tips', [
            'name' => 'Lorem',
        ]);
    }

    /** @test */
    public function update_tip()
    {
        $tip = Tip::factory()->create();

        $this->actingAs($this->user)
            ->putJson(route('tips.update', $tip->id), [
                'name' => 'Updated tip',
            ])
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseHas('tips', [
            'id' => $tip->id,
            'name' => 'Updated tip',
        ]);
    }

    /** @test */
    public function show_tip()
    {
        $tip = Tip::factory()->create();

        $this->actingAs($this->user)
            ->getJson(route('tips.show', $tip->id))
            ->assertSuccessful()
            ->assertJson([
                'data' => [
                    'name' => $tip->name,
                ]
            ]);
    }

    /** @test */
    public function list_tip()
    {
        $tips = Tip::factory()->count(2)->create()->map(function ($tip) {
            return $tip->only(['id', 'name']);
        });

        $this->actingAs($this->user)
            ->getJson(route('tips.index'))
            ->assertSuccessful()
            ->assertJson([
                 'data' => $tips->toArray()
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
    public function delete_tip()
    {
        $tip = Tip::factory()->create([
            'name' => 'Tip for delete',
        ]);

        $this->actingAs($this->user)
            ->deleteJson(route('tips.update', $tip->id))
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseMissing('tips', [
            'id' => $tip->id,
            'name' => 'Tip for delete',
        ]);
    }
}
