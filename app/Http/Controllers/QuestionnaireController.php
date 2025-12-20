<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;
use Illuminate\Support\Facades\Auth;

class QuestionnaireController extends Controller
{
    public function intro()
    {
        return view('questionnaire.intro');
    }

    public function start()
    {
        return redirect()->route('questionnaire.page', ['page' => 1]);
    }

    public function page($page)
    {
        // Each page contains 5 questions
        $perPage = 5;

        // Total questions = 30 (fixed)
        $totalQuestions = 30;
        $totalPages = ceil($totalQuestions / $perPage);

        if ($page < 1 || $page > $totalPages) {
            abort(404, 'Page not found');
        }

        return view('questionnaire.page', [
            'page' => $page,
            'totalPages' => $totalPages,
        ]);
    }

    public function savePage(Request $request, $page)
    {
        $answers = $request->input('answers', []);

        $existing = session('questionnaire_answers', []);

        // QUESTION RANGE INDEX : 1–30
        $start = ($page - 1) * 5 + 1;
        $end = $start + 4;

        // Remove only answers from this page
        for ($i = $start; $i <= $end; $i++) {
            unset($existing[$i]);
        }

        // Save answers
        foreach ($answers as $q => $val) {
            $existing[$q] = $val;
        }

        session(['questionnaire_answers' => $existing]);

        if ($page < 6) {
            return redirect()->route('questionnaire.page', ['page' => $page + 1]);
        }

        return redirect()->route('questionnaire.submit');
    }

    public function submit()
    {
        $answers = session('questionnaire_answers', []);

        if (empty($answers)) {
            return redirect()->route('questionnaire.intro')
                ->with('error', 'No answers found!');
        }

        $totalScore = array_sum($answers);
        $maxScore = count($answers) * 5;

        $level = $totalScore <= 45 ? 'Normal' : 'High';
        $color = $level === 'Normal' ? '#c7ceea' : '#ff9aa2';
        $message = $level === 'Normal'
            ? "Great! Your sugar craving level is NORMAL 🌸"
            : "Oops! Your sugar craving level is HIGH 😮";

        Result::updateOrCreate([
            'user_id'    => auth()->id(),
            'totalScore' => $totalScore,
            'maxScore'   => $maxScore,
            'level'      => $level,
            'answers'    => $answers,
        ]);

        session()->forget('questionnaire_answers');

        return view('questionnaire.result', compact(
            'totalScore',
            'maxScore',
            'level',
            'color',
            'message'
        ));
    }

    public function showResult() {
    $result = \App\Models\Result::where('user_id', Auth::id())
                ->latest()
                ->first();

    if (!$result) {
        return redirect()->route('questionnaire.intro')
                         ->with('error', 'No result found. Please complete the questionnaire.');
    }

    return view('questionnaire.result', [
        'totalScore' => $result->totalScore,
        'maxScore'   => $result->maxScore,
        'level'      => $result->level,
        'color'      => $result->level === 'Normal' ? '#c7ceea' : '#ff9aa2',
        'message'    => $result->level === 'Normal'
                         ? "Great! Your sugar craving level is NORMAL 🌸"
                         : "Oops! Your sugar craving level is HIGH 😮",
    ]);
}

}
