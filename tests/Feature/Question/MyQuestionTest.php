<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

test("should list all the my questions", function () {
    $otherUser = User::factory()->create();
    $user = User::factory()->create();
    actingAs($user);

    $otherQuestions = Question::factory(1)->for($otherUser, "createdBy")->create();
    $questions = Question::factory(1)->for($user, "createdBy")->create();

    $response = get(route('question.index'))
        ->assertOk();

    foreach ($questions as $item) {
        $response->assertSee($item->question);
    }

    foreach ($otherQuestions as $item) {
        $response->assertDontSee($item->question);
    }
});
