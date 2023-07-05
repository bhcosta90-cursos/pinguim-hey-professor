<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, post};

test('should be a create a new question bigger than 255 characters', function () {
    $user = User::factory()->create();
    actingAs($user);

    $response = post(route('question.store'), [
        'question' => str_repeat('*', 265) . '?',
    ]);

    $response->assertRedirect(route('dashboard'));
    $this->assertDatabaseCount('questions', 1);
    $this->assertDatabaseHas('questions', [
        'question' => str_repeat('*', 265) . '?',
    ]);
});

test("should check if end with question mark ?", function () {
    $user = User::factory()->create();
    actingAs($user);

    $response = post(route('question.store'), [
        'question' => "Are you sure that is a question? It's missing the question mark in the end",
    ]);

    $response->assertSessionHasErrors([
        'question' => "Are you sure that is a question? It's missing the question mark in the end"])
    ->assertRedirect();

    $this->assertDatabaseCount('questions', 0);
});

test("should have a least 10 characters", function () {
    $user = User::factory()->create();
    actingAs($user);

    $response = post(route('question.store'), [
        'question' => str_repeat('*', 8) . '?',
    ]);
    $response->assertSessionHasErrors(['question' => __('validation.min.string', ['min' => 10, 'attribute' => 'question'])])
        ->assertRedirect();

    $this->assertDatabaseCount('questions', 0);
});
