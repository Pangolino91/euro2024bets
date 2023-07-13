<?php

namespace App\Http\Controllers;

use App\Models\Bet;
use App\Models\User;
use App\Http\Requests\StoreBetRequest;
use App\Http\Requests\UpdateBetRequest;

class BetController extends Controller
{

    public function leaderboard() {
        $leaderboard = User::where('is_admin', "=", 0)->orderBy('points')
        ->get();

        return view('leaderboard', ["leaderboard" => $leaderboard]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBetRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Bet $bet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bet $bet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBetRequest $request, Bet $bet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bet $bet)
    {
        //
    }
}
