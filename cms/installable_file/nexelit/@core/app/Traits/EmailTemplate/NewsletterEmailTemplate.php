<?php

namespace App\Traits\EmailTemplate;

use App\Helpers\LanguageHelper;

trait NewsletterEmailTemplate
{
    /**
     * send newsletterVerifyMail
     * */
    public function newsletterVerifyMail($newsletter)
    {
        $message = get_static_option('newsletter_verify_' . LanguageHelper::user_lang_slug() . '_message');
        $message = $this->parseNewsletterInfo($message, $newsletter);

        return [
            'subject' => get_static_option('newsletter_verify_' . LanguageHelper::user_lang_slug() . '_subject'),
            'message' => $message,
        ];
    }

    /*
      * Parse newsletter info for mail
      * */
    private function parseNewsletterInfo(string $message, $newsletter)
    {
        $message = str_replace(
            [
                '@verify_code',
                '@site_title',
            ],
            [
                '<p class="btn-wrap"> <a  href="' . route('subscriber.verify', ['token' => $newsletter->token]) . '">' . route('subscriber.verify', ['token' => $newsletter->token]) . '</a></p>',
                get_static_option('site_' . LanguageHelper::user_lang_slug() . '_title')
            ], $message);
        return $message;
    }

}