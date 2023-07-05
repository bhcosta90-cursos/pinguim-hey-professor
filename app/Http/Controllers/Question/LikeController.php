<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\{RedirectResponse, Request};

class LikeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Question $question): RedirectResponse
    {
        $question->votes()->create([
            'user_id' => $request->user()->id,
            'like' => true,
            'unlike' => false,
        ]);

        return back();
    }
}
