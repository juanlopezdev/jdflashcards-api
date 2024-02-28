<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Subject;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Card::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
            'state' => 'integer',
            'subject_id' => 'required|integer|exists:subjects,id',
            'user_id' => 'required|integer|exists:users,id'
        ]);

        $card = Card::create($request->all());
        return response()->json($card, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Card $card)
    {
        return $card;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Card $card)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
            'state' => 'integer',
            'subject_id' => 'required|integer|exists:subjects,id',
            'user_id' => 'required|integer|exists:users,id'
        ]);

        $card->update($request->all());

        return response()->json($card);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Card $card)
    {
        $card->delete();
        return response()->json(null, 204);
    }

    public function cardsBySubject(Subject $subject)
    {
        $cards = Card::where('subject_id', $subject->id)->get();
        return response()->json($cards);
    }
}
