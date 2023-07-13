<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Fixture;
use App\Models\Bet;
use App\Http\Requests\StoreFixtureRequest;
use App\Http\Requests\UpdateFixtureRequest;


use Carbon\Carbon;

class FixtureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $currentDate = Carbon::now()->format('Y-m-d');
        $user = Auth::user();
        
        $fixtures = Fixture::where('kickoff', '>=', $currentDate)
                            ->orderBy('kickoff')
                            ->get()
                            ->map(function ($fixture) use ($user) {
                                $fixture->in_user_bets = $this->checkUserBet($fixture, $user);
                                return $fixture;
                            });
        // dd($fixtures);
        return view('fixtures', ['fixtures' => $fixtures]);
    }

    private function checkUserBet($fixture, $user)
    {
        $bet = $user->bets()->where('fixture_id', $fixture->id)->first();
        // dd($user->bets);
        
        // dd($bet);
        
        return $bet;
    }

    public function place_bet(Request $request) {
        $user = Auth::user();

        $validatedData = $request->validate(Bet::getValidationRules());
        $fixtureId = $validatedData['fixture_id'];
        $prediction = $validatedData['prediction'];
        

        $IsThereBetAlready = $user->bets->where('fixture_id', $fixtureId)->first();
        if ($IsThereBetAlready) {
            return redirect()->route('fixtures')->with('error', 'Bet already placed');
        }
        $bet = new Bet();
        $bet->user()->associate($user);
        $bet->fixture_id = $fixtureId;
        $bet->prediction = $prediction;
        $bet->save();

        

        return redirect()->route('fixtures')->with('success', 'Bet placed successfully');
    }

    public function match_details(Request $request, $fixture_id) {
        $fixture = Fixture::find($fixture_id);

    
        // Pass the fixture data to the view
        return view('fixture', ['fixture' => $fixture]);
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
    public function store(StoreFixtureRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Fixture $fixture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fixture $fixture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFixtureRequest $request, Fixture $fixture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fixture $fixture)
    {
        //
    }
}
