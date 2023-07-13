<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'home_team',
        'away_team',
        'kickoff',
        'result'
    ];
    
    protected $casts = [
        'kickoff' => 'datetime',
    ];

    public function bets()
    {
        return $this->hasMany(Bet::class, 'fixture_id');
    }

    public function has_results() {
        return $this->result !== null && $this->result !== "pending";
    }
}
