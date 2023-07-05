<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Rules\EndWithQuestionMarkRule;
use Illuminate\Http\{RedirectResponse, Request};

class StoreController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $request->validate([
            'question' => ['required', 'min:10', new EndWithQuestionMarkRule()],
        ]);

        Question::query()->create([
            'question' => $request->question,
            'draft' => false,
        ]);

        return to_route('dashboard');
    }
}
