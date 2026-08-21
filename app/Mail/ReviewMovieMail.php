<?php

namespace App\Mail;

use App\Models\Movie;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReviewMovieMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Movie $movie;

    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    public function build()
    {
        return $this
            ->subject('What did you think about ' . $this->movie->title . '?')
            ->view('emails.review-movie');
    }
}
