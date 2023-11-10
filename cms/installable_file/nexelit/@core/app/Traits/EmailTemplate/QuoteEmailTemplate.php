<?php

namespace App\Traits\EmailTemplate;

use App\Helpers\LanguageHelper;

trait QuoteEmailTemplate
{
    /**
     * send appointmentBookingMailUser
     * */
    public function quoteAdminMail($quote_details)
    {
        $message = get_static_option('quote_admin_mail_' . LanguageHelper::user_lang_slug() . '_message');
        $message = $this->parseQuoteInfo($message, $quote_details);
        return [
            'subject' => get_static_option('quote_admin_mail_' . LanguageHelper::user_lang_slug() . '_subject'),
            'message' => $message,
            'attachments' => unserialize($quote_details->attachment,['class' => false])
        ];
    }
    private function parseQuoteInfo($message, $quote_details)
    {
        $message = str_replace(
            [
                '@quote_info_table',
                '@quote_submit_date',
                '@site_title',
            ],
            [
                $this->quoteInfoTable($quote_details),
                $quote_details->created_at->format('d F Y H:m:s'),
                get_static_option('site_' . LanguageHelper::user_lang_slug() . '_title'),
            ], $message);
        return $message;
    }

    private function quoteInfoTable($quote_details)
    {
        $all_custom_fields = unserialize($quote_details->custom_fields,['class' => false]);


        $output = '<table>';
        foreach($all_custom_fields as $key => $field){
            $name = str_replace(['-','_'],[' ',' '],$key);
            $output .= '<tr>';
            $output .= '<td>'.__(ucwords($name)).'</td>';
            $output .= '<td>'.str_replace('_',' ',$field).'</td>';
            $output .= '</tr>';
        }
        $output .= '</table>';

        return $output;
    }
}