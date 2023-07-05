<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Rules\EndWithQuestionMarkRule;
use Illuminate\Http\{RedirectResponse, Request};

class QuestionController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'question' => ['required', 'min:10', new EndWithQuestionMarkRule],
        ]);

        Question::query()->create([
            'question' => $request->question,
        ]);

        return to_route('dashboard');
    }
}
