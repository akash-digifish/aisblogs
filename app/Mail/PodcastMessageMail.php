<?php

namespace App\Mail;

use App\Models\Podcast;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PodcastMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $podcast;

    /**
     * Create a new message instance.
     */
    public function __construct(Podcast $podcast)
    {
        $this->podcast = $podcast;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Podcast Created: ' . $this->podcast->name)
                    ->markdown('emails.podcast.message')
                    ->with([
                        'name'    => $this->podcast->name,
                        'email'   => $this->podcast->email,
                        'company' => $this->podcast->company,
                        'msg'     => $this->podcast->msg,
                    ]);
    }
}
