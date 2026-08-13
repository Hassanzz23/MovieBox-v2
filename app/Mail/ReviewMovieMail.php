<?php

namespace App\Mail;

use App\Models\Todo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReviewMovieMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Todo $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function build()
    {
        return $this
            ->subject('What did you think about ' . $this->todo->title . '?')
            ->view('emails.review-movie');
    }
}