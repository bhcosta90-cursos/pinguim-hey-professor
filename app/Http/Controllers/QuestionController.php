<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Rules\{EndWithQuestionMarkRule, SameQuestionRule};
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
            'archivedQuestions' => $request->user()->questions()->onlyTrashed()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'question' => ['required', 'min:10', new EndWithQuestionMarkRule(), new SameQuestionRule()],
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
            'question' => ['required', 'min:10', new EndWithQuestionMarkRule(), new SameQuestionRule()],
        ]);

        $question->update([
            'question' => $request->question,
        ]);

        return to_route('question.index');
    }

    public function archive(Question $question): RedirectResponse
    {
        $this->authorize('archive', $question);

        $question->delete();

        return back();
    }

    public function restore(string $id): RedirectResponse
    {
        $question = Question::withTrashed()->find($id);

        $this->authorize('restore', $question);

        $question->restore();

        return back();
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
