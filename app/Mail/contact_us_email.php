<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class contact_us_email extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name;
    public $email;
    public $comment;

    public function __construct($name,$email,$msg)
    {
        $this->name = $name;
        $this->email = $email;
        $this->comment = $msg;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('partho@wrctpl.com', 'Crypto Share')
        ->subject('Contact Us')
        ->view('email.contact_us');
    }
}
