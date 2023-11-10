<?php

namespace App\Traits\EmailTemplate;

use App\Helpers\LanguageHelper;

trait CourseEmailTemplate
{
    /**
     * send courseEnrollUserMail
     * */
    public function courseReminderMail($enroll_details)
    {
        $message = get_static_option('course_payment_accept_' . LanguageHelper::user_lang_slug() . '_message');
        $message = $this->parseCurseInfo($message, $enroll_details);
        return [
            'subject' => get_static_option('course_payment_accept_' . LanguageHelper::user_lang_slug() . '_subject'),
            'message' => $message,
        ];
    }

    /**
     * send courseEnrollUserMail
     * */
    public function coursePaymentAcceptMail($enroll_details)
    {
        $message = get_static_option('course_payment_accept_' . LanguageHelper::user_lang_slug() . '_message');
        $message = $this->parseCurseInfo($message, $enroll_details);
        return [
            'subject' => get_static_option('course_payment_accept_' . LanguageHelper::user_lang_slug() . '_subject'),
            'message' => $message,
        ];
    }


    /**
     * send courseEnrollUserMail
     * */
    public function courseEnrollUserMail($enroll_details)
    {
        $message = get_static_option('course_enroll_user_' . LanguageHelper::user_lang_slug() . '_message');
        $message = $this->parseCurseInfo($message, $enroll_details);
        return [
            'subject' => get_static_option('course_enroll_user_' . LanguageHelper::user_lang_slug() . '_subject'),
            'message' => $message,
        ];
    }

    /**
     * send courseEnrollAdminMail
     * */
    public function courseEnrollAdminMail($enroll_details)
    {
        $message = get_static_option('course_enroll_admin_' . LanguageHelper::user_lang_slug() . '_message');
        $message = $this->parseCurseInfo($message, $enroll_details);
        return [
            'subject' => get_static_option('course_enroll_admin_' . LanguageHelper::user_lang_slug() . '_subject'),
            'message' => $message,
        ];
    }

    private function parseCurseInfo($message, $enroll_details)
    {
        $message = str_replace(
            [
                '@course_title',
                '@course_instructor',
                '@course_price',
                '@course_enroll_id',
                '@course_payment_gateway',
                '@course_payment_date',
                '@student_username',
                '@student_name',
                '@site_title',
                '@user_dashboard',
            ],
            [
                optional(optional($enroll_details->course)->lang)->title,
                optional(optional($enroll_details->course)->instructor)->name,
                amount_with_currency_symbol(optional($enroll_details->course)->price),
                $enroll_details->id,
                $enroll_details->payment_gateway,
                $enroll_details->created_at->format('d F Y H:m:s'),
                optional($enroll_details->user)->username,
                optional($enroll_details->user)->name,
                get_static_option('site_' . LanguageHelper::user_lang_slug() . '_title'),
                '<div class="btn-wrap"><a href="' . route('user.home') . '" class="anchor-btn">' . __('more info') . '</a></div>'
            ], $message);
        return $message;
    }
}