<?php

namespace App\Traits\EmailTemplate;

use App\AppointmentBookingTime;
use App\Helpers\LanguageHelper;

trait AppointmentEmailTemplates
{

    /**
     * send appointmentBookingMailUser
     * */
    public function appointmentReminderMail($appointment_booking_details)
    {
        $message = get_static_option('appointment_reminder_mail_' . LanguageHelper::user_lang_slug() . '_message');
        $message = $this->parseAppointmentInfo($message, $appointment_booking_details);
        return [
            'subject' => get_static_option('appointment_reminder_mail_' . LanguageHelper::user_lang_slug() . '_subject'),
            'message' => $message
        ];
    }

    /**
     * send appointmentBookingMailUser
     * */
    public function appointmentPaymentAcceptMail($appointment_booking_details)
    {
        $message = get_static_option('appointment_payment_accept_' . LanguageHelper::user_lang_slug() . '_message');
        $message = $this->parseAppointmentInfo($message, $appointment_booking_details);
        return [
            'subject' => get_static_option('appointment_payment_accept_' . LanguageHelper::user_lang_slug() . '_subject'),
            'message' => $message
        ];
    }


    /**
     * send appointmentBookingMailUser
     * */
    public function appointmentBookingUpdateMail($appointment_booking_details)
    {
        $message = get_static_option('appointment_booking_update_' . LanguageHelper::user_lang_slug() . '_message');
        $message = $this->parseAppointmentInfo($message, $appointment_booking_details);
        return [
            'subject' => get_static_option('appointment_booking_update_' . LanguageHelper::user_lang_slug() . '_subject'),
            'message' => $message
        ];
    }

    /**
     * send appointmentBookingMailUser
     * */
    public function appointmentBookingMailUser($appointment_booking_details)
    {
        $message = get_static_option('appointment_booking_user_' . LanguageHelper::user_lang_slug() . '_message');
        $message = $this->parseAppointmentInfo($message, $appointment_booking_details);
        return [
            'subject' => get_static_option('appointment_booking_user_' . LanguageHelper::user_lang_slug() . '_subject'),
            'message' => $message,
            'attachments' => $appointment_booking_details->all_attachment
        ];
    }

    /**
     * send appointmentBookingMailAdmin
     * */
    public function appointmentBookingMailAdmin($appointment_booking_details)
    {
        $message = get_static_option('appointment_booking_admin_' . LanguageHelper::user_lang_slug() . '_message');
        $message = $this->parseAppointmentInfo($message, $appointment_booking_details);
        return [
            'subject' => get_static_option('appointment_booking_admin_' . LanguageHelper::user_lang_slug() . '_subject'),
            'message' => $message,
            'attachments' => $appointment_booking_details->all_attachment
        ];
    }
    private function parseAppointmentInfo($message, $appointment_booking_details)
    {
        $new_booking_time = AppointmentBookingTime::findOrFail($appointment_booking_details->booking_time_id);
        $message = str_replace(
            [
                '@appointment_info_table',
                '@appointment_title',
                '@payment_status',
                '@booking_date',
                '@booking_id',
                '@appointment_payment_gateway',
                '@appointment_payment_date',
                '@billing_name',
                '@billing_email',
                '@site_title',
                '@booking_time',
                '@user_dashboard',
            ],
            [
                $this->appointmentInfoTable($appointment_booking_details),
                optional(optional($appointment_booking_details->appointment)->lang)->title,
                $appointment_booking_details->payment_status,
                $appointment_booking_details->booking_date,
                $appointment_booking_details->id,
                str_replace('_',' ',$appointment_booking_details->payment_gateway),
                $appointment_booking_details->created_at->format('d F Y H:m:s'),
                $appointment_booking_details->name,
                $appointment_booking_details->email,
                get_static_option('site_' . LanguageHelper::user_lang_slug() . '_title'),
                $new_booking_time->time ?? __('not set'),
                '<div class="btn-wrap"><a href="'.route('user.home').'" class="anchor-btn">'.__('Dashboard').'</a></div>'
            ], $message);
        return $message;
    }

    private function appointmentInfoTable($appointment_booking_details)
    {
        $all_custom_fields = $appointment_booking_details->custom_fields;
        unset($all_custom_fields['appointment_id']);
        $all_custom_fields['booking_id'] = '#'.$appointment_booking_details->id;

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