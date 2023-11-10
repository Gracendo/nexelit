<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BasicMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($args)
    {
        $this->data = $args;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->from(get_static_option('site_global_email'), get_static_option('site_'.get_default_language().'_title'))
            ->subject($this->data['subject'])
            ->view('mail.basic-mail-template');

        if (isset($this->data['attachments'])){
            if (is_array($this->data['attachments'])){
                $attachments = $this->data['attachments'];
                foreach ($attachments as $field_name => $attached_file){
                    if (file_exists($attached_file)){
                        $mail->attach($attached_file);
                    }
                }
            }
        }

        //add attachment support
        return $mail;
    }
}
