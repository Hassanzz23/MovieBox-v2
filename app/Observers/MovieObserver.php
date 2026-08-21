<?php

namespace App\Observers;

use App\Models\Movie;
use App\Mail\ReviewMovieMail;
use Illuminate\Support\Facades\Mail;

class MovieObserver
{
    /**
     * Handle the Movie "created" event.
     */
    public function created(Movie $movie): void
    {
        //
    }

    /**
     * Handle the Movie "updated" event.
     */
    public function updated(Movie $movie): void
    {
        if ($movie->wasChanged('status') && $movie->status === true) {

            Mail::to($movie->user->email)
                ->queue(new ReviewMovieMail($movie));
        }
    }

    /**
     * Handle the Movie "deleted" event.
     */
    public function deleted(Movie $movie): void
    {
        //
    }

    /**
     * Handle the Movie "restored" event.
     */
    public function restored(Movie $movie): void
    {
        //
    }

    /**
     * Handle the Movie "force deleted" event.
     */
    public function forceDeleted(Movie $movie): void
    {
        //
    }
}
