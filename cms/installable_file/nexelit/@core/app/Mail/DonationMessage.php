<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DonationMessage extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $subject;
    public $type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$subject,$type)
    {
        $this->data = $data;
        $this->subject = $subject;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->from(get_static_option('site_global_email'), get_static_option('site_'.get_default_language().'_title'))
        ->subject($this->subject)
        ->view('mail.donation-payment-success');
        return $mail;
    }
}
