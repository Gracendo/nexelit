<?php

namespace App\Mail;

use App\Helpers\LanguageHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminResetEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $default_lang = LanguageHelper::default_slug();
        return $this->from(get_static_option('site_global_email'), get_static_option('site_'.$default_lang.'_title'))
            ->subject(get_static_option('admin_reset_password_'.$default_lang.'_subject'))
            ->view('mail.admin-pass-reset');
    }
}
