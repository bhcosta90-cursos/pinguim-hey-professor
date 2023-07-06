<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Rules\EndWithQuestionMarkRule;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\View\View;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        return view('question.index', [
            'questions' => $request->user()->questions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'question' => ['required', 'min:10', new EndWithQuestionMarkRule()],
        ]);

        $request->user()->questions()->create([
            'question' => $request->question,
            'draft' => true,
        ]);

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question): View
    {
        $this->authorize('update', $question);

        return view('question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question): RedirectResponse
    {
        $this->authorize('update', $question);

        $request->validate([
            'question' => ['required', 'min:10', new EndWithQuestionMarkRule()],
        ]);

        $question->update([
            'question' => $request->question,
        ]);

        return to_route('question.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question): RedirectResponse
    {
        $this->authorize('delete', $question);
        $question->forceDelete();

        return back();
    }
}
