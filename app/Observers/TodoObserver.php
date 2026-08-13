<?php

namespace App\Observers;

use App\Models\Todo;
use App\Mail\ReviewMovieMail;
use Illuminate\Support\Facades\Mail;

class TodoObserver
{
    /**
     * Handle the Todo "created" event.
     */
    public function created(Todo $todo): void
    {
        //
    }

    /**
     * Handle the Todo "updated" event.
     */
    public function updated(Todo $todo): void
    {
        if ($todo->wasChanged('status') && $todo->status === true) {

            Mail::to($todo->user->email)
                ->queue(new ReviewMovieMail($todo));
        }
    }

    /**
     * Handle the Todo "deleted" event.
     */
    public function deleted(Todo $todo): void
    {
        //
    }

    /**
     * Handle the Todo "restored" event.
     */
    public function restored(Todo $todo): void
    {
        //
    }

    /**
     * Handle the Todo "force deleted" event.
     */
    public function forceDeleted(Todo $todo): void
    {
        //
    }
}
