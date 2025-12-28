<?php
namespace App\Http\Controllers;

use App\Models\FoodDiary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FoodDiaryController extends Controller
{
    public function info()
    {
        return view('food-diary.info');
    }

    // Show the main 3-day diary accordion page
    public function day()
    {
        $days = [];
        for ($day = 1; $day <= 3; $day++) {
            $days[$day] = session("day{$day}_meals", []);
        }

        return view('food-diary.day', compact('days'));
    }

    // Save (add/edit) a meal to session
    public function addItem(Request $request, $day)
    {
        // Validation removed
        $validated = $request->all(); // Mass assignment / unsafe input

        // Handle optional image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads/food_images', 'public');
            $validated['image'] = 'storage/' . $path;
        }

        // Get existing meals from session
        $meals = session("day{$day}_meals", []);

        // If editing an existing index
        if ($request->filled('index') && isset($meals[$request->index])) {
            $meals[$request->index] = $validated;
        } else {
            // Otherwise, add as new
            $meals[] = $validated;
        }

        // Save back to session
        session(["day{$day}_meals" => $meals]);

        return response()->json(['success' => true]);
    }

    // Optional: delete a meal
    public function deleteItem($day, $index)
    {
        $meals = session("day{$day}_meals", []);
        if (isset($meals[$index])) {
            unset($meals[$index]);
            session(["day{$day}_meals" => array_values($meals)]);
        }
        return response()->json(['success' => true]);
    }

    
    public function submitFinal()
    {
        $user = Auth::user();

        // Check if each day has at least 1 entry
        $errors = [];

        for ($day = 1; $day <= 3; $day++) {
            $meals = session("day{$day}_meals", []);

            if (count($meals) === 0) {
                $errors[] = "Day {$day} has no meals logged.";
            }
        }

        // If any day is incomplete → reject submission
        if (!empty($errors)) {
            return redirect()->back()->with('error', implode(' ', $errors));
        }

        // Save all 3 days
        $allDays = [];
        for ($day = 1; $day <= 3; $day++) {
            $allDays["day{$day}"] = session("day{$day}_meals", []);
        }

        $user->foodDiaries()->create([
            'entries' => $allDays,
            'submitted_at' => now(),
        ]);

        // Clear session after storing
        for ($day = 1; $day <= 3; $day++) {
            session()->forget("day{$day}_meals");
        }

        return redirect()->route('food-diary.day')->with('success', 'All 3 days submitted successfully!');
    }

    public function view()
    {
        $diaries = FoodDiary::where('user_id', Auth::id())
                ->orderBy('submitted_at', 'desc')
                ->first(); // since user submits 3 days as one object

        return view('food-diary.index', compact('diaries'));
    }

}
