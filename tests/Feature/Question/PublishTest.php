<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, put};

test("should be able to publish question", function () {
    $user = User::factory()->create();
    actingAs($user);

    $question = Question::factory()
        ->for($user, "createdBy")
        ->create(['draft' => true]);

    put(route('question.publish', $question->id))
        ->assertRedirect();

    $question->refresh();

    expect($question->draft)->toBeFalse();
});

test("should make sure that only the person who has created the question can publish the question", function () {
    $userWrong = User::factory()->create();
    $user = User::factory()->create();
    actingAs($userWrong);

    $question = Question::factory()
        ->for($user, 'createdBy')
        ->create(['draft' => true]);

    put(route('question.publish', $question->id))
        ->assertForbidden();
});
