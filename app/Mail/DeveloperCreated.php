<?php

namespace App\Mail;

use App\Developer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeveloperCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Developer
     */
    public $developer;



    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Developer $developer)
    {
        $this->developer = $developer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('emily.hagood@generationtux.com')
            ->view('emails.developer.created')
            ->with('developer', $this->developer);
    }
}
