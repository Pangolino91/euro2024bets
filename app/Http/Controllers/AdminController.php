<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\Fixture;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function dashboard()
    {
        $user = Auth::user();
        if($user->is_admin) {
            return redirect()->route('admin.match-fixture');
        }

        return redirect()->route('fixtures');
        
    }

    public function match_fixture()
    {
        $fixtures = Fixture::orderBy('kickoff')
        ->get();

        return view('admin.match-fixture', ["fixtures" => $fixtures]);
    }

    public function create_fixture(Request $request) {
        // $user = Auth::user();

        $validatedData = $request->validate([]);
        $kickoff_date = $request->input('kickoff_date');
        $kickoff_time = $request->input('kickoff_time');
        $home_team = $request->input('home_team');
        $away_team = $request->input('away_team');

        $fixture = new Fixture();
        $fixture->kickoff = Carbon::parse($kickoff_date . ' ' . $kickoff_time);;
        $fixture->home_team = $home_team;
        $fixture->away_team = $away_team;
        $fixture->save();

        return redirect()->route('admin.match-fixture')->with('success', 'Fixture created successfully');
    }
    
    public function set_fixture_results(Request $request, $fixture_id)
    {
        // Retrieve the fixture data based on the $fixture_id
        $fixture = Fixture::find($fixture_id);

        if ($request->isMethod('post')) {
            // Handle the POST request and update the fixture
            $result = $request->input("match_result");
            $fixture->result = $result;
            $fixture->save();

            return redirect()->route('admin.match-fixture')->with('success', 'Match fixture results updated successfully');
        }
    
        // Pass the fixture data to the view
        return view('admin.match-results', ['fixture' => $fixture]);
    }

    public function leaderboard() {
        $leaderboard = User::where('is_admin', "=", 0)->orderBy('points')
        ->get();

        return view('admin.leaderboard', ["leaderboard" => $leaderboard]);
    }
}
