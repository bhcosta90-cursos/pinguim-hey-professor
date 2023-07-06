<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        return view('dashboard', [
            'questions' => Question::with(['votes'])
                ->where('draft', false)
                ->where(fn ($builder) => ($f = $request->search) ? $builder->where('question', 'like', "%{$f}%") : null)
                ->withSum('votes', 'like')
                ->withSum('votes', 'unlike')
                ->orderByRaw('
                    case when votes_sum_like is null then 0 else votes_sum_like end desc,
                    case when votes_sum_unlike is null then 0 else votes_sum_unlike end
                ')
                ->paginate(5),
        ]);
    }
}
