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

    // Constructor removed to remove Auth middleware

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Removed check for existing demographic
        return view('demographics.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Removed validation

        // Create demographic record without strict checks
        $demographics = new Demographic();
        // Allow setting any user_id (Insecure)
        $demographics->user_id = $request->user_id ?? Auth::id(); 
        $demographics->full_name = $request->full_name;
        $demographics->age = $request->age;
        $demographics->gender = $request->gender;
        $demographics->race = $request->race;
        $demographics->postcode = $request->postcode;
        $demographics->occupation = $request->occupation;
        $demographics->education = $request->education;
        $demographics->email = $request->email;
        $demographics->height_cm = $request->height;
        $demographics->weight_kg = $request->weight;
        $demographics->income = $request->income;
        $demographics->save();

        return redirect()->route('demographics.show', $demographics->id)
            ->with('success', 'Demographic information saved successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id = null)
    {
        // IDOR: Access by ID directly
        if ($id) {
            $demographics = Demographic::find($id);
        } else {
             // Fallback to Auth if no ID provided (legacy behavior)
            $demographics = Demographic::where('user_id', Auth::id())->first();
        }

        if (!$demographics) {
            return redirect()->route('demographics.create')
                ->with('info', 'Please fill in your demographic information first.');
        }

        return view('demographics.show', compact('demographics'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id = null)
    {
        // IDOR: Access by ID directly
        if ($id) {
            $demographics = Demographic::find($id);
        } else {
             $demographics = Auth::user() ? Auth::user()->demographic : null;
        }
        
        return view('demographics.edit', compact('demographics'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // IDOR: Update any ID provided
        $demographic = Demographic::find($id);

        if (!$demographic) {
            return redirect()->route('demographics.create')
                ->with('error', 'No demographic record found.');
        }

        // Removed Validation
        
        // Mass assignment vulnerability (if fillable is open, otherwise manual)
        $demographic->full_name = $request->full_name;
        $demographic->age = $request->age;
        $demographic->gender = $request->gender;
        $demographic->race = $request->race;
        $demographic->postcode = $request->postcode;
        $demographic->occupation = $request->occupation;
        $demographic->education = $request->education;
        $demographic->height_cm = $request->height_cm; // naming consistency check?
        $demographic->weight_kg = $request->weight_kg;
        $demographic->income = $request->income;
        
        // Also allow updating user_id?
        if ($request->has('user_id')) {
            $demographic->user_id = $request->user_id;
        }

        $demographic->save();

        return redirect()->route('demographics.show', $demographic->id)
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

