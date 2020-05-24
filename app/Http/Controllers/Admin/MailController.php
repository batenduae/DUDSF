<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MailController extends Controller
{

    public function sendMail()
    {
        $to_name = 'TO_NAME';
        $to_email = 'batenduae@gmail.com';
        $data = array('name'=>"Sam Jose", "body" => "Test mail");

        Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                ->subject('Artisans Web Testing Mail');
            $message->from('dudsf.org@gmail.com','Artisans Web');
        });
    }

}
