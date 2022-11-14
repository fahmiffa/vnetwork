<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MyMail extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details,$link)
    {
        $this->details = $details;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from(ENV('MAIL_FROM_ADDRESS'), $this->details['subject'])
        ->subject('Mail from '.ENV('APP_NAME'))
        ->view('email.mail',['link'=>$this->link]);
    }
}
