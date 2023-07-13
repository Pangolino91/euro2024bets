<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

use App\Models\User;

class Bet extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fixture()
    {
        return $this->belongsTo(Fixture::class);
    }

    public function processResult() {
        $fixture = $this->fixture;
        $user = $this->user;

        if ($this->prediction === $fixture->result && $this->correct === null) {
            $this->correct = true;
            $this->save();

            $user->increment('points');
        }elseif ($this->prediction !== $fixture->result && $this->correct === null) {
            $this->correct = false;
            $this->save();
        }
    }

    public static function getValidationRules()
    {
        // Call using $validatedData = $request->validate(Bet::getValidationRules());
        $currentDateTime = Carbon::now();
        $bettableDateTime = $currentDateTime->subMinutes(30)->format('Y-m-d H:i:s');

        return [
            'prediction' => ['required', Rule::in(['home', 'draw', 'away'])],
            'fixture_id' => ['required', Rule::exists('fixtures', 'id')
                ->where(function ($query) use ($bettableDateTime) {
                    $query->where('kickoff', '>', $bettableDateTime);
                })],
        ];
    }
}
