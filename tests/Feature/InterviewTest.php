<?php

namespace Tests\Feature;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Interview;
use Tests\TestCase;

class InterviewTest extends TestCase
{
    /** @var User */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /** @test */
    public function create_interview()
    {
        $this->actingAs($this->user)
            ->postJson(route('interviews.store'), [
                'name' => 'Lorem'
            ])
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseHas('interviews', [
            'name' => 'Lorem',
        ]);
    }

    /** @test */
    public function update_interview()
    {
        $interview = Interview::factory()->create();

        $this->actingAs($this->user)
            ->putJson(route('interviews.update', $interview->id), [
                'name' => 'Updated interview',
            ])
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseHas('interviews', [
            'id' => $interview->id,
            'name' => 'Updated interview',
        ]);
    }

    /** @test */
    public function show_interview()
    {
        $interview = Interview::factory()->create();

        $this->actingAs($this->user)
            ->getJson(route('interviews.show', $interview->id))
            ->assertSuccessful()
            ->assertJson([
                'data' => [
                    'name' => $interview->name,
                ]
            ]);
    }

    /** @test */
    public function list_interview()
    {
        $interviews = Interview::factory()->count(2)->create()->map(function ($interview) {
            return $interview->only(['id', 'name']);
        });

        $this->actingAs($this->user)
            ->getJson(route('interviews.index'))
            ->assertSuccessful()
            ->assertJson([
                 'data' => $interviews->toArray()
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
    public function delete_interview()
    {
        $interview = Interview::factory()->create([
            'name' => 'Interview for delete',
        ]);

        $this->actingAs($this->user)
            ->deleteJson(route('interviews.update', $interview->id))
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseMissing('interviews', [
            'id' => $interview->id,
            'name' => 'Interview for delete',
        ]);
    }
}
