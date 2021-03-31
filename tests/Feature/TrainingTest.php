<?php

namespace Tests\Feature;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Training;
use Tests\TestCase;

class TrainingTest extends TestCase
{
    /** @var User */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /** @test */
    public function create_training()
    {
        $this->actingAs($this->user)
            ->postJson(route('trainings.store'), [
                'name' => 'Lorem'
            ])
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseHas('trainings', [
            'name' => 'Lorem',
        ]);
    }

    /** @test */
    public function update_training()
    {
        $training = Training::factory()->create();

        $this->actingAs($this->user)
            ->putJson(route('trainings.update', $training->id), [
                'name' => 'Updated training',
            ])
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseHas('trainings', [
            'id' => $training->id,
            'name' => 'Updated training',
        ]);
    }

    /** @test */
    public function show_training()
    {
        $training = Training::factory()->create();

        $this->actingAs($this->user)
            ->getJson(route('trainings.show', $training->id))
            ->assertSuccessful()
            ->assertJson([
                'data' => [
                    'name' => $training->name,
                ]
            ]);
    }

    /** @test */
    public function list_training()
    {
        $trainings = Training::factory()->count(2)->create()->map(function ($training) {
            return $training->only(['id', 'name']);
        });

        $this->actingAs($this->user)
            ->getJson(route('trainings.index'))
            ->assertSuccessful()
            ->assertJson([
                 'data' => $trainings->toArray()
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
    public function delete_training()
    {
        $training = Training::factory()->create([
            'name' => 'Training for delete',
        ]);

        $this->actingAs($this->user)
            ->deleteJson(route('trainings.update', $training->id))
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseMissing('trainings', [
            'id' => $training->id,
            'name' => 'Training for delete',
        ]);
    }
}
