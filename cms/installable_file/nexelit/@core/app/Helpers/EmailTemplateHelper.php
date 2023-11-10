<?php

namespace App\Helpers;

use App\PaymentLogs;
use App\PricePlan;
use App\Traits\EmailTemplate\AppointmentEmailTemplates;
use App\Traits\EmailTemplate\CourseEmailTemplate;
use App\Traits\EmailTemplate\DonationEmailTemplate;
use App\Traits\EmailTemplate\EventEmailTemplate;
use App\Traits\EmailTemplate\ProductEmailTemplate;
use App\Traits\EmailTemplateHelperTrait;
use App\Traits\EmailTemplate\JobEmailTemplate;
use App\Traits\EmailTemplate\NewsletterEmailTemplate;
use App\Traits\EmailTemplate\PackageOrderEmailTemplate;
use App\Traits\EmailTemplate\QuoteEmailTemplate;
use Illuminate\Support\Str;

class EmailTemplateHelper
{
use EmailTemplateHelperTrait,
    PackageOrderEmailTemplate,
    QuoteEmailTemplate,
    CourseEmailTemplate,
    JobEmailTemplate,
    EventEmailTemplate,
    ProductEmailTemplate,
    AppointmentEmailTemplates,
    DonationEmailTemplate,
    NewsletterEmailTemplate;


    /**
     * send userVerifyMail
     * */
    public function userVerifyMail($user)
    {
        $message = get_static_option('user_email_verify_' . LanguageHelper::user_lang_slug() . '_message');
        $message = $this->parseUserInfo($message, $user);
        return [
            'subject' => get_static_option('user_email_verify_' . LanguageHelper::user_lang_slug() . '_subject'),
            'message' => $message,
        ];
    }

    /*
     * Parse user info for mail
     * */
    private function parseUserInfo(string $message, $user)
    {
        $message = str_replace(
            [
                '@name',
                '@username',
                '@verify_code',
                '@site_title',
            ],
            [
                $user->name,
                $user->username,
                '<span class="verify-code">' . $user->email_verify_token . '</span>',
                get_static_option('site_' . LanguageHelper::user_lang_slug() . '_title')
            ], $message);
        return $message;
    }



}