<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class RegistrationConfirmation extends Mailable
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('emails.registration_confirmation')
            ->subject('Your account is registered');
    }
}
