<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNewUserWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    //necessario istanziare user per richiamarlo nel construct
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    //passando $datiutente in questo modo saranno accessibili alla mia view 
    public function __construct($datiUtente)
    {
        $this->user = $datiUtente;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.newUserWelcome');
    }
}
