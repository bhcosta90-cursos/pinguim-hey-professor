<?php

use App\Models\{Question, User};
use Illuminate\Pagination\LengthAwarePaginator;

use function Pest\Laravel\{actingAs, get};

test("should list all the questions", function () {
    $user = User::factory()->create();
    $questions = Question::factory()->count(5)->create(['draft' => false]);

    actingAs($user);

    // Act
    $response = get(route('dashboard'));

    // Assert
    /** @var Question $q */
    foreach ($questions as $q) {
        $response->assertSee($q->question);
    }
});

test("should paginate the result", function () {
    $user = User::factory()->create();
    Question::factory()->for($user, 'createdBy')
        ->count(20)
        ->create(['draft' => false]);

    actingAs($user);

    get(route('dashboard'))
        ->assertViewHas('questions', function ($value) {
            return $value instanceof LengthAwarePaginator;
        });
});

test('should order by like and unlike, most liked question should be at the top, most unliked questions should be in the bottom', function () {
    $user = User::factory()->create();
    $secondUser = User::factory()->create();
    $questions = Question::factory(5)->create(['draft' => false]);

    $mostLikedQuestion = $questions[2];
    $user->like($mostLikedQuestion);

    $mostUnlikedQuestion = $questions[1];
    $secondUser->unlike($mostUnlikedQuestion);

    actingAs($user);
    get(route('dashboard'))
        ->assertViewHas('questions', function ($questions) use ($mostLikedQuestion, $mostUnlikedQuestion) {
            expect($questions)
                ->first()->id->toBe($mostLikedQuestion->id)
                ->and($questions)
                ->last()->id->toBe($mostUnlikedQuestion->id);

            return true;
        });
});
