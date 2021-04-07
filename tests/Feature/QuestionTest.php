<?php

namespace Tests\Feature;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Question;
use Tests\TestCase;

class QuestionTest extends TestCase
{
    /** @var User */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /** @test */
    public function create_question()
    {
        $this->actingAs($this->user)
            ->postJson(route('questions.store'), [
                'name' => 'Lorem'
            ])
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseHas('questions', [
            'name' => 'Lorem',
        ]);
    }

    /** @test */
    public function update_question()
    {
        $question = Question::factory()->create();

        $this->actingAs($this->user)
            ->putJson(route('questions.update', $question->id), [
                'name' => 'Updated question',
            ])
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseHas('questions', [
            'id' => $question->id,
            'name' => 'Updated question',
        ]);
    }

    /** @test */
    public function show_question()
    {
        $question = Question::factory()->create();

        $this->actingAs($this->user)
            ->getJson(route('questions.show', $question->id))
            ->assertSuccessful()
            ->assertJson([
                'data' => [
                    'name' => $question->name,
                ]
            ]);
    }

    /** @test */
    public function list_question()
    {
        $questions = Question::factory()->count(2)->create()->map(function ($question) {
            return $question->only(['id', 'name']);
        });

        $this->actingAs($this->user)
            ->getJson(route('questions.index'))
            ->assertSuccessful()
            ->assertJson([
                 'data' => $questions->toArray()
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
    public function delete_question()
    {
        $question = Question::factory()->create([
            'name' => 'Question for delete',
        ]);

        $this->actingAs($this->user)
            ->deleteJson(route('questions.update', $question->id))
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseMissing('questions', [
            'id' => $question->id,
            'name' => 'Question for delete',
        ]);
    }
}
