<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BuyForm extends Mailable
{
    protected $name, $email, $message, $phone;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $phone, $tariph)
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $tariph;
        $this->phone = $phone;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.buy_form',
         [  'name'=>$this->name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'mess'=>$this->message
        ]);
    }
}
