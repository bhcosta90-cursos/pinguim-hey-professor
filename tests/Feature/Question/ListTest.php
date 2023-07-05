<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

todo("should list all the questions", function () {
    $user = User::factory()->create();
    $questions = Question::factory()->count(5)->create();

    actingAs($user);

    // Act
    $response = get(route('dashboard'));

    // Assert
    /** @var Question $q */
    foreach ($questions as $q) {
        $response->assertSee($q->question);
    }
});
