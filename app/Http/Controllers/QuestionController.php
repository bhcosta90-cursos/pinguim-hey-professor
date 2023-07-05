<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Closure;
use Illuminate\Http\{RedirectResponse, Request, Response};

class QuestionController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'question' => ['required', 'min:10', function (string $attribute, string $value, Closure $fail) {
                if (substr($value, -1) != '?') {
                    $fail("Are you sure that is a question? It's missing the question mark in the end");
                }
            }],
        ]);

        Question::query()->create([
            'question' => $request->question,
        ]);

        return to_route('dashboard');
    }
}
