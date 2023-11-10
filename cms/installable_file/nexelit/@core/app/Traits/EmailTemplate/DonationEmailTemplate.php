<?php

namespace App\Traits\EmailTemplate;

use App\Helpers\LanguageHelper;

trait DonationEmailTemplate
{
    /**
     * send donationReminderMail
     * */
    public function donationReminderMail($donation_log_details)
    {
        $message = get_static_option('donation_payment_reminder_mail_' . LanguageHelper::user_lang_slug() . '_message');
        $message = $this->parseDonationInfo($message, $donation_log_details);
        return [
            'subject' => get_static_option('donation_payment_reminder_mail_' . LanguageHelper::user_lang_slug() . '_subject'),
            'message' => $message,
        ];
    }


    /**
     * send donationPaymentAcceptMail
     * */
    public function donationPaymentAcceptMail($donation_log_details)
    {
        $message = get_static_option('donation_payment_accept_mail_' . LanguageHelper::user_lang_slug() . '_message');
        $message = $this->parseDonationInfo($message, $donation_log_details);
        return [
            'subject' => get_static_option('donation_payment_accept_mail_' . LanguageHelper::user_lang_slug() . '_subject'),
            'message' => $message,
        ];
    }

    /**
     * send donationUserMail
     * */
    public function donationUserMail($donation_log_details)
    {
        $message = get_static_option('donation_user_mail_' . LanguageHelper::user_lang_slug() . '_message');
        $message = $this->parseDonationInfo($message, $donation_log_details);
        return [
            'subject' => get_static_option('donation_user_mail_' . LanguageHelper::user_lang_slug() . '_subject'),
            'message' => $message,
        ];
    }


    /**
     * send donationAdminMail
     * */
    public function donationAdminMail($donation_log_details)
    {
        $message = get_static_option('donation_admin_mail_' . LanguageHelper::user_lang_slug() . '_message');
        $message = $this->parseDonationInfo($message, $donation_log_details);
        return [
            'subject' => get_static_option('donation_admin_mail_' . LanguageHelper::user_lang_slug() . '_subject'),
            'message' => $message,
        ];
    }

    private function parseDonationInfo($message, $donation_log_details)
    {
        $message = str_replace(
            [
                '@donation_id',
                '@donor_name',
                '@donation_cause_title',
                '@payment_gateway',
                '@payment_status',
                '@donation_time',
                '@amount',
                '@amount_title',
                '@donation_info',
                '@user_dashboard',
                '@site_title',
            ],
            [
                $donation_log_details->id,
                $donation_log_details->name,
                optional($donation_log_details->donation)->title,
                str_replace('-','_',$donation_log_details->payment_gateway),
                $donation_log_details->status,
                $donation_log_details->created_at->format('D,  d-m-y h:i:s'),
                amount_with_currency_symbol($donation_log_details->amount),
                $this->donationAmountTitle($donation_log_details),
                $this->donationInfo($donation_log_details),
                ' <a href="'.route('user.home').'">'.__('your dashboard').'</a>',
                get_static_option('site_' . LanguageHelper::user_lang_slug() . '_title')
            ], $message);
        return $message;
    }

    private function donationInfo($donation_log_details)
    {
        $output = '<table>';
        $output .= '<tr><td>'.__('Donate ID').'</td> <td>#'.$donation_log_details->donation_id.'</td> </tr>';
        $output .= '<tr><td>'.__('Cause Name').'</td> <td>'.optional($donation_log_details->donation)->title.'</td> </tr>';
        $output .= '<tr><td>'.__('Donate Amount').'</td> <td>'.amount_with_currency_symbol($donation_log_details->amount).'</td> </tr>';
        $output .= '<tr><td>'.__('Payment Gateway').'</td> <td>'.ucfirst(str_replace('_',' ',$donation_log_details->payment_gateway)).'</td> </tr>';
        $output .= '<tr><td>'.__('Payment Status').'</td> <td>'.$donation_log_details->status.'</td> </tr>';
        $output .= '<tr><td>'.__('Transaction ID').'</td> <td>'.$donation_log_details->transaction_id.'</td> </tr>';
        $output .= '</table>';
        return $output;
    }

    private function donationAmountTitle($donation_log_details)
    {
        return ' <div class="price-wrap">'.amount_with_currency_symbol($donation_log_details->amount).'</div>';
    }
}