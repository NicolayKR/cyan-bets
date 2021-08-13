<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactForm extends Mailable
{
    use Queueable, SerializesModels;

    protected $name, $email, $surname, $message, $phone;
    protected $basket;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $phone, $mess)
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $mess;
        $this->phone = $phone;
    }
    //Для корзины
    //Как параметр в конструктор просто передадим $order
    // public function __construct($name, $basket)
    // {
    //     $this->name = $name;
    //     $this->basket = $basket;
    // }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.contact_form',
         [  'name'=>$this->name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'mess'=>$this->message
        ]);
    }
}
