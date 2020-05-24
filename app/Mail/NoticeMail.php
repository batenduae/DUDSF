<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NoticeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $admins;
    public $count;
    public function __construct($var1,$var2)
    {
        $this->admins = $var1;
        $this->count = $var2;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()/* this is the main function which executes whenever an object of this
    mailable class is created after the execution of the constructor function */
    {
        return $this->from('dudsf.org@gmail.com', 'DUDSF')
                    ->subject('Registration Summary For '. now())
                    ->replyTo('dudsf.org@gmail.com', 'Reply Address')
                    ->view('admin.emails.mail1');
    }
}
