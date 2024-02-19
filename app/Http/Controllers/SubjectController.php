<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Subject::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'state' => 'integer',
            'user_id' => 'required|integer',
        ]);

        $subject = Subject::create($request->all());
        return response()->json($subject, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        return $subject;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'state' => 'integer',
        ]);

        $subject->update($request->all());

        return response()->json($subject);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return response()->json(null, 204);
    }

    /**
     * Get the subjects by the logged user.
     */
    public function subjectsByLoggedUser()
    {
        $userId = Auth::id();
        $subjects = Subject::where('user_id', $userId)->get();
        return response()->json($subjects);
    }
}
