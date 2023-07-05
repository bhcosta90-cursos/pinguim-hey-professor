<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, post};

test("should be able to like a question", function () {
    $user = User::factory()->create();

    $question = Question::factory()->create();

    actingAs($user);

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

    $question = Question::factory()->create();

    actingAs($user);

    post(route('question.unlike', $question))
        ->assertRedirect();

    assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'like' => false,
        'unlike' => true,
        'user_id' => $user->id,
    ]);
});
