<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $activation_link;
    public $config_email;

    public function __construct($activation_link, $config_email)
    {
        $this->activation_link = $activation_link;
        $this->config_email = $config_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        return $this->from($this->config_email, 'Crypto Share')->subject('Activation Link from Crypto Share')->view('emails.registration');
    }
}
