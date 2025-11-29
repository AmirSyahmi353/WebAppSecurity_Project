<?php


namespace App\Http\Controllers;

use App\Models\Demographic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemographicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // If demographic already exists, skip form
        $existing = Demographic::where('user_id', Auth::id())->first();

        if ($existing) {
            return redirect()->route('home')->with('info', 'You have already completed your profile.');
        }

        return view('demographics.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|numeric',
            'gender' => 'required|string|max:50',
            'race' => 'required|string|max:50',
            'postcode' => 'required|string|max:10',
            'occupation' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'email' => 'required|email',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'income' => 'required|string|max:20',
        ]);

        // Create demographic record
        $demographics = new Demographic();
        $demographics->user_id         = Auth::id();
        $demographics->full_name  = ucwords(strtolower($request->full_name));
        $demographics->age        = $request->age;
        $demographics->gender     = ucfirst(strtolower($request->gender));
        $demographics->race       = ucwords(strtolower($request->race));
        $demographics->postcode   = $request->postcode;
        $demographics->occupation = ucwords(strtolower($request->occupation));
        $demographics->education  = ucwords(strtolower($request->education));
        $demographics->email      = strtolower($request->email);
        $demographics->height_cm  = $request->height;
        $demographics->weight_kg  = $request->weight;
        $demographics->income     = $request->income;
        $demographics->save();

        return redirect()->route('demographics.show', $demographics->_id)
                 ->with('success', 'Demographic information saved successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $demographics = Demographic::where('user_id', Auth::id())->first();

        if (!$demographics) {
            return redirect()->route('demographics.create')
                            ->with('info', 'Please fill in your demographic information first.');
        }

        return view('demographics.show', compact('demographics'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit() {
        $demographics = Auth::user()->demographic; // get current user's data
        return view('demographics.edit', compact('demographics'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
{
    $demographic = Auth::user()->demographic;

    if (!$demographic) {
        return redirect()->route('demographics.create')
                         ->with('error', 'No demographic record found.');
    }

    $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|numeric',
            'gender' => 'required|string|max:50',
            'race' => 'required|string|max:50',
            'postcode' => 'required|string|max:10',
            'occupation' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'height_cm' => 'required|numeric',
            'weight_kg' => 'required|numeric',
            'income' => 'required|string|max:20',
        ]);

    
    $validated['full_name']  = ucwords(strtolower($validated['full_name']));
    $validated['gender']     = ucfirst(strtolower($validated['gender']));
    $validated['race']       = ucwords(strtolower($validated['race']));
    $validated['occupation'] = ucwords(strtolower($validated['occupation']));
    $validated['education']  = ucwords(strtolower($validated['education']));
    $demographic->update($validated);

    return redirect()->route('demographics.show', Auth::id())
                     ->with('success', 'Profile updated successfully!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Demographic $demographic)
    {
        //
    }
}

