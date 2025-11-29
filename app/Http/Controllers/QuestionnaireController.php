<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use Illuminate\Http\Request;
use App\Models\Result;
use Illuminate\Support\Facades\Auth;

class QuestionnaireController extends Controller
{
    public function intro()
    {
        return view('questionnaire.intro');
    }
    
    public function start(Request $request)
    {
        // Redirect to page 1 of questionnaire
        return redirect()->route('questionnaire.page', ['page' => 1]);
    }
    
    public function page($page)
    {
        $questions = [
            1 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Agar-agar/jelly/ pudding/ tau-foo fah'],
            2 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Air batu campur (ABC)/ cendol/ laici kang'],
            3 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Biscuits (creamed/ flavored) / Cookies'],
            4 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Porridge (e.g.: caca, corn, red beans)'],
            5 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Bun (with filling/ topping)'],
            6 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Cake/Muffin / Swiss roll/ Brownies'],
            7 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Candy/Sweets'],
            8 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Banana dumpling'],
            9 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Chocolate (usual/ dark/ white)'],
            10 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Dodol/ Wajik/Lempuk'],
            11 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Donuts (filled/ spring)/ Cinnamon rolls/ Sweet potato rolls'],
            12 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Fruits juices (bottle/ can/ carton)'],
            13 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Dried fruits'],
            14 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Ice-cream/popsicles'],
            15 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Egg jam'],
            16 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Fruit jam'],
            17 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Traditional kuihs (eg. apam, bingka, kasui, ketayap, keria, koci, seri muka, tepung pelita)'],
            18 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Traditional kuihs (with condiments)'],
            19 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Dumpling (egg jam/redbean fillings)'],
            20 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => "Lepat' (e.g. banana, tapioca)"],
            21 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Pancake (with syrup) / waffle (with topping)'],
            22 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Pop corn (caramel)'],
            23 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Soft drink (carbonated)'],
            24 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Instant drink 3 in 1/ sachet/ packed/ can (e.g. soy, tea, sugarcane)'],
            25 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Drinks (e.g.: tea, iced tea, rose drink, coffee, malt drink)'],
            26 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Drinks with sweetened condensed milk'],
            27 => ['image' => 'assets/img/questionnaire/q27.png', 'text' => 'Flavored milk (e.g.: chocolate, strawberry, corn)'],
            28 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Flavored cordial (e.g. sarsi, grapes, oranges)'],
            29 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Canned fruits (e.g.: lychee, pineapple)'],
            30 => ['image' => 'assets/img/questionnaire/q30.png', 'text' => 'Energy bar (e.g. Snickers, Mars)'],
        ];

        $perPage = 5;
        $totalPages = ceil(count($questions) / $perPage);

        $pageQuestions = array_slice($questions, ($page - 1) * $perPage, $perPage, true);

        if (empty($pageQuestions)) {
            abort(404, 'Page not found');
        }

        return view('questionnaire.page', [
            'page' => $page,
            'questions' => $pageQuestions,
            'totalPages' => $totalPages,
        ]);
    }

    public function savePage(Request $request, $page)
{
    $answers = $request->input('answers', []);

    // Load existing but editable answers
    $existing = session('questionnaire_answers', []);

    // PAGE QUESTION INDEX RANGE
    $start = ($page - 1) * 5 + 1;   // 1, 6, 11, 16, 21, 26
    $end   = $start + 4;            // 5, 10, 15, 20, 25, 30

    // Remove old answers from that page only
    for ($i = $start; $i <= $end; $i++) {
        unset($existing[$i]);
    }

    // Insert new answers for that page
    foreach ($answers as $q => $val) {
        $existing[$q] = $val;
    }

    // Save updated structured answers
    session(['questionnaire_answers' => $existing]);

    // If not last page → next
    if ($page < 6) {
        return redirect()->route('questionnaire.page', ['page' => $page + 1]);
    }

    // If last → submit
    return redirect()->route('questionnaire.submit');
}


   public function submit()
{
    $answers = session('questionnaire_answers', []);

    if (empty($answers)) {
        return redirect()->route('questionnaire.intro')->with('error', 'No answers found!');
    }

    $totalScore = array_sum($answers);
    $questionCount = count($answers);
    $maxScore = $questionCount * 5;

    // ✅ Two-category scoring
    if ($totalScore <= 45) {
        $level = "Normal";
        $color = "#c7ceea";
        $message = "Great! Your sugar craving level is NORMAL 🌸";
    } else {
        $level = "High";
        $color = "#ff9aa2";
        $message = "Oops! Your sugar craving level is HIGH 😮";
    }

    // Save to MongoDB
    Result::create([
        'user_id' => auth()->id(),
        'totalScore' => $totalScore,
        'maxScore' => $maxScore,
        'level' => $level,
        'answers' => $answers
    ]);

    session()->forget('questionnaire_answers');

    return view('questionnaire.result', compact(
        'totalScore',
        'maxScore',
        'level',
        'color',     // ✅ This was missing
        'message'
    ));
}

public function result()
{
    // Example: get current user results
    $userId = auth()->id();
    $result = QuestionnaireResult::where('user_id', $userId)->first();

    return view('questionnaire.result', compact('result'));
}

public function showResult()
{
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


//     /**
//      * Display a listing of the resource.
//      */
//     public function index()
//     {
//         $question = Questionnaire::first(); // just get first one for test
//         return view('questionnaires.index', compact('question'));
//     }

//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create()
//     {
//         //
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(Request $request)
//     {
//         //
//     }

//     /**
//      * Display the specified resource.
//      */
//     public function show(Questionnaire $questionnaire)
//     {
//         //
//     }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(Questionnaire $questionnaire)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, Questionnaire $questionnaire)
//     {
//         //
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(Questionnaire $questionnaire)
//     {
//         //
//     }
}
