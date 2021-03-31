<?php

namespace Tests\Feature;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Command;
use Tests\TestCase;

class CommandTest extends TestCase
{
    /** @var User */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /** @test */
    public function create_command()
    {
        $this->actingAs($this->user)
            ->postJson(route('commands.store'), [
                'name' => 'Lorem'
            ])
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseHas('commands', [
            'name' => 'Lorem',
        ]);
    }

    /** @test */
    public function update_command()
    {
        $command = Command::factory()->create();

        $this->actingAs($this->user)
            ->putJson(route('commands.update', $command->id), [
                'name' => 'Updated command',
            ])
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseHas('commands', [
            'id' => $command->id,
            'name' => 'Updated command',
        ]);
    }

    /** @test */
    public function show_command()
    {
        $command = Command::factory()->create();

        $this->actingAs($this->user)
            ->getJson(route('commands.show', $command->id))
            ->assertSuccessful()
            ->assertJson([
                'data' => [
                    'name' => $command->name,
                ]
            ]);
    }

    /** @test */
    public function list_command()
    {
        $commands = Command::factory()->count(2)->create()->map(function ($command) {
            return $command->only(['id', 'name']);
        });

        $this->actingAs($this->user)
            ->getJson(route('commands.index'))
            ->assertSuccessful()
            ->assertJson([
                 'data' => $commands->toArray()
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
    public function delete_command()
    {
        $command = Command::factory()->create([
            'name' => 'Command for delete',
        ]);

        $this->actingAs($this->user)
            ->deleteJson(route('commands.update', $command->id))
            ->assertSuccessful()
            ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

        $this->assertDatabaseMissing('commands', [
            'id' => $command->id,
            'name' => 'Command for delete',
        ]);
    }
}
