<?php

namespace App\Traits\EmailTemplate;

use App\Helpers\LanguageHelper;

trait JobEmailTemplate
{
    /**
     * send jobUserMail
     * */
    public function jobUserMail($applicant_details)
    {
        $message = get_static_option('job_user_mail_' . LanguageHelper::user_lang_slug() . '_message');
        $message = $this->parseJobInfo($message, $applicant_details);
        return [
            'subject' => get_static_option('job_user_mail_' . LanguageHelper::user_lang_slug() . '_subject'),
            'message' => $message,
        ];
    }

    /**
     * send jobAdminMail
     * */
    public function jobAdminMail($applicant_details)
    {
        $message = get_static_option('job_admin_mail_' . LanguageHelper::user_lang_slug() . '_message');
        $message = $this->parseJobInfo($message, $applicant_details);
        return [
            'subject' => get_static_option('job_admin_mail_' . LanguageHelper::user_lang_slug() . '_subject'),
            'message' => $message,
        ];
    }

    private function parseJobInfo($message, $applicant_details)
    {
        $message = str_replace(
            [
                '@applicant_id',
                '@applicant_name',
                '@job_title',
                '@job_application_time',
                '@site_title',
            ],
            [
                $applicant_details->id,
                $applicant_details->name,
                optional($applicant_details->job)->title,
                $applicant_details->created_at->format('D , d m y h:i:s'),
                get_static_option('site_' . LanguageHelper::user_lang_slug() . '_title')
            ], $message);
        return $message;
    }

}