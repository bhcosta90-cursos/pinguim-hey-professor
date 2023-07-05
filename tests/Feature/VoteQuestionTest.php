<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post};

test("should be able to like a question", function () {
    $user = User::factory()->create();
    actingAs($user);

    $question = Question::factory()->create();

    post(route('question.like', $question))
        ->assertRedirect();

    assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'like' => true,
        'unlike' => false,
        'user_id' => $user->id,
    ]);
});

test("should be able to unlike a question", function () {
    $user = User::factory()->create();
    actingAs($user);

    $question = Question::factory()->create();

    post(route('question.unlike', $question))
        ->assertRedirect();

    assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'like' => false,
        'unlike' => true,
        'user_id' => $user->id,
    ]);
});

test("should not be able to like more than 1 time by user", function () {
    $user = User::factory()->create();
    actingAs($user);

    $question = Question::factory()->create();

    post(route('question.like', $question))
        ->assertRedirect();

    post(route('question.like', $question))
        ->assertRedirect();

    post(route('question.like', $question))
        ->assertRedirect();

    post(route('question.like', $question))
        ->assertRedirect();

    assertDatabaseCount('votes', 1);

    $user = User::factory()->create();
    actingAs($user);

    post(route('question.like', $question))
        ->assertRedirect();

    assertDatabaseCount('votes', 2);
});

test("should not be able to unlike more than 1 time by user", function () {
    $user = User::factory()->create();
    actingAs($user);

    $question = Question::factory()->create();

    post(route('question.unlike', $question))
        ->assertRedirect();

    post(route('question.unlike', $question))
        ->assertRedirect();

    post(route('question.unlike', $question))
        ->assertRedirect();

    post(route('question.unlike', $question))
        ->assertRedirect();

    assertDatabaseCount('votes', 1);

    $user = User::factory()->create();
    actingAs($user);

    post(route('question.unlike', $question))
        ->assertRedirect();

    assertDatabaseCount('votes', 2);
});
