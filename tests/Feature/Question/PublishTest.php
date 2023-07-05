<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, put};

test("should be able to publish question", function () {
    $user = User::factory()->create();
    actingAs($user);

    $question = Question::factory()->create(['draft' => true]);

    put(route('question.publish', $question->id))
        ->assertRedirect();

    $question->refresh();

    // expect($question->draft)->toBeFalse();
});
