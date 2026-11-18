<?php

use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('saves rooms and shares their beds with another staff account', function () {
    $first = User::factory()->create(['role' => 'nurse']);
    $second = User::factory()->create(['role' => 'doctor']);

    $this->actingAs($first)->postJson(route('rooms.store'), [
        'number' => '307', 'floor' => '3', 'beds' => ['A', 'B', 'C'],
    ])->assertCreated()->assertJsonPath('room.beds', ['A', 'B', 'C']);

    $this->actingAs($second)->getJson(route('rooms.index'))
        ->assertOk()->assertJsonFragment(['number' => '307', 'floor' => '3', 'beds' => ['A', 'B', 'C']]);
    expect(Room::count())->toBe(1);
});

it('rejects duplicate rooms and duplicate bed identifiers', function () {
    $this->actingAs(User::factory()->create());
    Room::create(['number' => '307', 'beds' => ['A']]);

    $this->postJson(route('rooms.store'), [
        'number' => '307', 'beds' => ['B'],
    ])->assertUnprocessable()->assertJsonValidationErrors('number');

    $this->postJson(route('rooms.store'), [
        'number' => '308', 'beds' => ['A', 'a'],
    ])->assertUnprocessable()->assertJsonValidationErrors('beds.0');

    expect(Room::count())->toBe(1);
});

it('requires a session to add a room', function () {
    $this->postJson(route('rooms.store'), [
        'number' => '307', 'beds' => ['A'],
    ])->assertUnauthorized();
    expect(Room::count())->toBe(0);
});
