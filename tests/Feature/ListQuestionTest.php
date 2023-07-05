<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

test("should list all the questions", function () {
    $user = User::factory()->create();
    actingAs($user);

    $questions = Question::factory(10)->create();

    $response = get(route('dashboard'));

    foreach ($questions as $item) {
        $response->assertSee($item->question);
    }
});
