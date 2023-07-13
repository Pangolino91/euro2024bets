<?php

namespace App\Observers;

use App\Models\Fixture;

class FixtureObserver
{
    /**
     * Handle the Fixture "created" event.
     */
    public function created(Fixture $fixture): void
    {
        //
    }

    /**
     * Handle the Fixture "updated" event.
     */
    public function updated(Fixture $fixture): void
    {
        if ($fixture->result && $fixture->result !== "pending") {
            $fixture->bets->each->processResult();
        }
    }

    /**
     * Handle the Fixture "deleted" event.
     */
    public function deleted(Fixture $fixture): void
    {
        //
    }

    /**
     * Handle the Fixture "restored" event.
     */
    public function restored(Fixture $fixture): void
    {
        //
    }

    /**
     * Handle the Fixture "force deleted" event.
     */
    public function forceDeleted(Fixture $fixture): void
    {
        //
    }
}
