<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        update_static_option('site_script_version','3.4.0');

        // $static_fields = [
        //      [
        //          'option_name' => 'donation_payment_reminder_mail_[lang]_subject',
        //          'option_value' => 'We are waiting for you',
        //      ],
        //     [
        //         'option_name' => 'donation_payment_reminder_mail_[lang]_message',
        //         'option_value' => "<p>Hello @donor_name,</p><p>your donation id # @donation_id is still in pending at @site_title</p><p>checkout your @user_dashboard for more info</p>",
        //     ],
        //     [
        //         'option_name' => 'donation_payment_accept_mail_'.'[lang]_subject',
        //         'option_value' => 'Your donation payment success',
        //     ], [
        //         'option_name' => 'donation_payment_accept_mail_'.'[lang]_message',
        //         'option_value' => 'Hello @donor_name,<div><br></div><div>Your payment is successful  @donation_id for donated cause @donation_cause_title paid via @payment_gateway at @donation_time</div><div><br></div><div>@amount</div><div><br></div><div>@donation_info</div>',
        //     ],
        //     [
        //         'option_name' => 'donation_admin_mail_'.'[lang]_subject',
        //         'option_value' => 'You have a new donation payment',
        //     ],
        //     [
        //         'option_name' => 'donation_admin_mail_'.'[lang]_message',
        //         'option_value' => '<p>Hello,</p><p>You get payment from @donor_name For donation log ID @donation_id for donated cause @donation_cause_title paid via @payment_gateway at @donation_time</p><p>@amount</p><p>@donation_info</p>',
        //     ],
        //     [
        //         'option_name' => 'donation_user_mail_'.'[lang]_subject',
        //         'option_value' => 'Your donation payment success',
        //     ],
        //     [
        //         'option_name' => 'donation_user_mail_'.'[lang]_message',
        //         'option_value' => 'Hello @donor_name,<div><br></div><div>Your payment is successful&nbsp; @donation_id for donated cause @donation_cause_title paid via @payment_gateway at @donation_time</div><div><br></div><div>@amount</div><div><br></div><div>@donation_info</div>',
        //     ],
        //     [
        //         'option_name' => 'package_order_reminder_mail_'.'[lang]_subject',
        //         'option_value' => 'We are waiting for you',
        //     ],
        //     [
        //         'option_name' => 'package_order_reminder_mail_'.'[lang]_message',
        //         'option_value' => '<p>Hello @billing_name,</p><p>your order @order_id is still in pending, to complete your order go to @user_dashboard</p>',
        //     ],
        //     [
        //         'option_name' => 'package_order_payment_accept_'.'[lang]_subject',
        //         'option_value' => 'your order has been placed successfully',
        //     ],
        //     [
        //         'option_name' => 'package_order_payment_accept_'.'[lang]_message',
        //         'option_value' => 'Hello @billing_name,<div><br></div><div>Your order has been placed successfully.</div><div><br></div><div>@order_billing_info</div><div>@order_price_plan</div>'
        //     ],
        //     [
        //         'option_name' => 'package_order_status_change_'.'[lang]_subject',
        //         'option_value' => 'your order status has been changed',
        //     ],
        //     [
        //         'option_name' => 'package_order_status_change_'.'[lang]_message',
        //         'option_value' => '<p>Hello @billing_name,</p><p>your order #@order_id status has been changed to @order_status</p>',
        //     ],
        //     [
        //         'option_name' => 'package_order_user_mail_'.'[lang]_subject',
        //         'option_value' => 'your order has been placed successfully',
        //     ],
        //     [
        //         'option_name' => 'package_order_user_mail_'.'[lang]_message',
        //         'option_value' => 'Hello @billing_name,<div>your order has been placed successfully ID, #@order_id, at @order_date via @order_payment_gateway<br></div><div><br></div><div><br></div><div><br></div><div>@order_billing_info</div><div><br></div><div>@order_price_plan</div>',
        //     ],
        //     [
        //         'option_name' => 'quote_admin_mail_'.'[lang]_subject',
        //         'option_value' => 'You have a new quote message',
        //     ],
        //     [
        //         'option_name' => 'quote_admin_mail_'.'[lang]_message',
        //         'option_value' => '<p>Hello,</p><p>you have a new quote message from @site_title submitted at @quote_submit_date.</p><p><br></p><p>@quote_info_table</p>',
        //     ],
        //     [
        //         'option_name' => 'course_payment_accept_'.'[lang]_subject',
        //         'option_value' => 'you have successfully enrolled',
        //     ],
        //     [
        //         'option_name' => 'course_payment_accept_'.'[lang]_message',
        //         'option_value' => 'Hello @student_name,<div><br></div><div>Your have enrolled in @course_title, Enroll ID #@course_enroll_id successful on @course_payment_date via @course_payment_gateway.</div><div><br></div><div>You have now full access to your enrolled courses, checkout your dashboard for more info.</div>',
        //     ],
        //     [
        //         'option_name' => 'course_reminder_mail_'.'[lang]_subject',
        //         'option_value' => 'We are waiting for you',
        //     ],
        //     [
        //         'option_name' => 'course_reminder_mail_'.'[lang]_message',
        //         'option_value' => '<p>Hello @student_name,</p><p><br></p><p>you have a pending Course Enroll id #@course_enroll_id at @site_title</p><p>checkout your @user_dashboard for more info.</p>',
        //     ],
        //     [
        //         'option_name' => 'course_enroll_user_'.'[lang]_subject',
        //         'option_value' => 'you have successfully enrolled',
        //     ],
        //     [
        //         'option_name' => 'course_enroll_user_'.'[lang]_message',
        //         'option_value' => 'Hello @student_name,<div><br></div><div>Your have enrolled in @course_title, Enroll ID #@course_enroll_id successful on @course_payment_date via @course_payment_gateway.</div><div><br></div><div>You have now full access to your enrolled courses, checkout your dashboard for more info.</div>',
        //     ],
        //     [
        //         'option_name' => 'course_enroll_admin_'.'[lang]_subject',
        //         'option_value' => 'you have a new course enrollment',
        //     ],
        //     [
        //         'option_name' => 'course_enroll_admin_'.'[lang]_message',
        //         'option_value' => '<p>Hello @student_name,</p><p>have a enrollment in @course_title, Enroll ID #@course_enroll_id successful on @course_payment_date via @course_payment_gateway.</p><p>You have now full access to your enrolled courses, checkout your dashboard for more info.</p>',
        //     ],
        //     [
        //         'option_name' => 'job_user_mail_'.'[lang]_subject',
        //         'option_value' => 'Your job application submitted successfully',
        //     ],
        //     [
        //         'option_name' => 'job_user_mail_'.'[lang]_message',
        //         'option_value' => '<p>Hello @applicant_name,</p><p>You job application submitted successfully.&nbsp;</p><p>Applicant ID #@applicant_id&nbsp; &nbsp;Applied to job post @job_title&nbsp; applied at @job_application_time</p>',
        //     ],
        //     [
        //         'option_name' => 'job_admin_mail_'.'[lang]_subject',
        //         'option_value' => 'You Have A New Job Applicant',
        //     ],
        //     [
        //         'option_name' => 'job_admin_mail_'.'[lang]_message',
        //         'option_value' => '<p>Hello ,</p><p>You have a new job applicant #@applicant_id, Name: @applicant_name,&nbsp;</p><p>Applied to job post @job_title applied at @job_application_time.</p><p><br></p><p>check admin panel for more info.</p>',
        //     ],
        //     [
        //         'option_name' => 'event_booking_reminder_'.'[lang]_subject',
        //         'option_value' => 'We Are Waiting for you.',
        //     ],
        //     [
        //         'option_name' => 'event_booking_reminder_'.'[lang]_message',
        //         'option_value' => '<p>Hello @billing_name,</p><p>your event booking @attendance_id is still in pending, to complete your booking checkout your&nbsp; @user_dashboard for more info</p>',
        //     ],
        //     [
        //         'option_name' => 'event_booking_payment_accept_'.'[lang]_subject',
        //         'option_value' => 'your event booking order has been placed',
        //     ],
        //     [
        //         'option_name' => 'event_booking_payment_accept_'.'[lang]_message',
        //         'option_value' => 'Hello,<div><br></div><div>your event booking order has been placed. attendance Id #@attendance_id,</div><div><br></div><div>at @attendance_date&nbsp;</div><div><br></div><div><br></div><div><br></div><div>@billing_info</div><div><br></div><div>@event_item</div><div><br></div><div><br></div>',
        //     ],
        //     [
        //         'option_name' => 'event_booking_user_mail_'.'[lang]_subject',
        //         'option_value' => 'your event booking order has been placed',
        //     ],
        //     [
        //         'option_name' => 'event_booking_user_mail_'.'[lang]_message',
        //         'option_value' => 'Hello,<div><br></div><div>your event booking order has been placed. attendance Id #@attendance_id,</div><div><br></div><div>at @attendance_date&nbsp;</div><div><br></div><div><br></div><div><br></div><div>@billing_info</div><div><br></div><div>@event_item</div><div><br></div><div><br></div>',
        //     ],
        //     [
        //         'option_name' => 'event_booking_admin_mail_'.'[lang]_subject',
        //         'option_value' => 'your have a new event booking order',
        //     ],
        //     [
        //         'option_name' => 'event_booking_admin_mail_'.'[lang]_message',
        //         'option_value' => 'Hello,<div><br></div><div>your event booking order has been placed. attendance Id #@attendance_id,</div><div><br></div><div>at @attendance_date&nbsp;</div><div><br></div><div><br></div><div><br></div><div>@billing_info</div><div><br></div><div>@event_item</div><div><br></div><div><br></div>',
        //     ],
        //     [
        //         'option_name' => 'product_order_status_change_mail_'.'[lang]_subject',
        //         'option_value' => 'your order status has been changed',
        //     ],
        //     [
        //         'option_name' => 'product_order_status_change_mail_'.'[lang]_message',
        //         'option_value' => '<p>Hello @billing_name,</p><p><br></p><p>You order #@order_id status has been changed to @order_status</p>',
        //     ],
        //     [
        //         'option_name' => 'product_order_reminder_mail_'.'[lang]_subject',
        //         'option_value' => 'We are waiting for you!',
        //     ],
        //     [
        //         'option_name' => 'product_order_reminder_mail_'.'[lang]_message',
        //         'option_value' => 'Hello @billing_name,<div><br></div><div>your order is still in pending at @site_title,</div><div>for more info checkout @user_dashboard</div>',
        //     ],
        //     [
        //         'option_name' => 'product_order_payment_accept_mail_'.'[lang]_subject',
        //         'option_value' => 'You order has been placed',
        //     ],
        //     [
        //         'option_name' => 'product_order_payment_accept_mail_'.'[lang]_message',
        //         'option_value' => 'Hello @billing_name,<div><br></div><div>You order has been placed #@order_id at @order_date via @payment_gateway.</div><div><br></div><div>@billing_info</div><div><br></div><div>@shipping_info</div><div><br></div><div>@cart_info</div><div><br></div><div>@order_summery</div>',
        //     ],
        //     [
        //         'option_name' => 'product_order_user_mail_'.'[lang]_subject',
        //         'option_value' => 'You order has been placed',
        //     ],
        //     [
        //         'option_name' => 'product_order_user_mail_'.'[lang]_message',
        //         'option_value' => 'Hello @billing_name,<div><br></div><div>You order has been placed #@order_id at @order_date via @payment_gateway.</div><div><br></div><div>@billing_info</div><div><br></div><div>@shipping_info</div><div><br></div><div>@cart_info</div><div><br></div><div>@order_summery</div>',
        //     ],
        //     [
        //         'option_name' => 'product_order_admin_mail_'.'[lang]_subject',
        //         'option_value' => 'You Have a new order',
        //     ],
        //     [
        //         'option_name' => 'product_order_admin_mail_'.'[lang]_message',
        //         'option_value' => '<p>Hello,</p><p>Your have a new order #@order_id @billing_name has been placed it on @order_date via @payment_gateway.</p><p>@billing_info</p><p>@shipping_info</p><p>@cart_info</p><p>@order_summery</p>',
        //     ],
        //     [
        //         'option_name' => 'donation_payment_reminder_mail_'.'[lang]_subject',
        //         'option_value' => 'We are waiting for you',
        //     ],
        //     [
        //         'option_name' => 'donation_payment_reminder_mail_'.'[lang]_message',
        //         'option_value' => '<p>Hello @donor_name,</p><p>your donation id # @donation_id is still in pending at @site_title</p><p>checkout your @user_dashboard for more info</p>',
        //     ],
        //     [
        //         'option_name' => 'donation_payment_accept_mail_'.'[lang]_subject',
        //         'option_value' => 'Your donation payment success',
        //     ],
        //     [
        //         'option_name' => 'donation_payment_accept_mail_'.'[lang]_message',
        //         'option_value' => 'Hello @donor_name,<div><br></div><div>Your payment is successful  @donation_id for donated cause @donation_cause_title paid via @payment_gateway at @donation_time</div><div><br></div><div>@amount</div><div><br></div><div>@donation_info</div>',
        //     ],
        //     [
        //         'option_name' => 'donation_user_mail_'.'[lang]_subject',
        //         'option_value' => 'Your donation payment success',
        //     ],
        //     [
        //         'option_name' => 'donation_user_mail_'.'[lang]_message',
        //         'option_value' => 'Hello @donor_name,<div><br></div><div>Your payment is successful&nbsp; @donation_id for donated cause @donation_cause_title paid via @payment_gateway at @donation_time</div><div><br></div><div>@amount</div><div><br></div><div>@donation_info</div>',
        //     ],
        //     [
        //         'option_name' => 'donation_admin_mail_'.'[lang]_subject',
        //         'option_value' => 'You have a new donation payment',
        //     ],
        //     [
        //         'option_name' => 'donation_admin_mail_'.'[lang]_message',
        //         'option_value' => '<p>Hello,</p><p>You get payment from @donor_name For donation log ID @donation_id for donated cause @donation_cause_title paid via @payment_gateway at @donation_time</p><p>@amount</p><p>@donation_info</p>',
        //     ],
        //     [
        //         'option_name' => 'newsletter_verify_'.'[lang]_subject',
        //         'option_value' => 'verify your email',
        //     ],
        //     [
        //         'option_name' => 'newsletter_verify_'.'[lang]_message',
        //         'option_value' => '<p>Hello,</p><p>verify your email to get all news from @site_title</p><p>@verify_code</p><p><br></p><p>Regards</p>',
        //     ],
        //     [
        //         'option_name' => 'product_view_option_button_'.'[lang]_text',
        //         'option_value' => __('View Options'),
        //     ],
        //     [
        //         'option_name' => 'product_download_now_button_'.'[lang]_text',
        //         'option_value' => __('Download Now'),
        //     ],
        //     [
        //         'option_name' => 'appointment_reminder_mail_'.'[lang]_subject',
        //         'option_value' => 'We are waiting for you',
        //     ],
        //     [
        //         'option_name' => 'appointment_reminder_mail_'.'[lang]_message',
        //         'option_value' => '<p>Hello @billing_name,</p><p>you have a pending booking id #@booking_id at @site_title,</p><p>checkout your @user_dashboard for more info</p>',
        //     ],

        //     [
        //         'option_name' => 'appointment_payment_accept_'.'[lang]_subject',
        //         'option_value' => 'Your payment has been approved',
        //     ],
        //     [
        //         'option_name' => 'appointment_payment_accept_'.'[lang]_message',
        //         'option_value' => '<p>Hello @billing_name</p><p>your payment has been approved for booking id #@booking_id, paid via @appointment_payment_gateway&nbsp;</p><p><br></p><p><br></p>',
        //     ],
        //     [
        //         'option_name' => 'appointment_booking_update_'.'[lang]_subject',
        //         'option_value' => 'Booking date and time updated',
        //     ],
        //     [
        //         'option_name' => 'appointment_booking_update_'.'[lang]_message',
        //         'option_value' => '<p>Hello @billing_name,</p><p>your booking date and time updated, booking id #@booking_id&nbsp; new date @booking_date time @booking_time</p>',
        //     ],
        //     [
        //         'option_name' => 'appointment_booking_user_'.'[lang]_subject',
        //         'option_value' => 'Your appointment booking has been placed successfully',
        //     ],
        //     [
        //         'option_name' => 'appointment_booking_user_'.'[lang]_message',
        //         'option_value' => 'Hello @billing_name,<div><br></div><div>Your appointment booking has been placed successfully , you have booked to @appointment_title from @site_title</div><div><br></div><div>@appointment_info_table</div>',
        //     ],
        //     [
        //         'option_name' => 'appointment_booking_admin_'.'[lang]_subject',
        //         'option_value' => 'Your have a new appointment booking',
        //     ],
        //     [
        //         'option_name' => 'appointment_booking_admin_'.'[lang]_message',
        //         'option_value' => 'Hello,<div><br></div><div>You have a new appointment booking  , booked to @appointment_title from @site_title</div><div><br></div><div>@appointment_info_table</div>',
        //     ],
        //     //
        // ];

        // $all_languages = \App\Helpers\LanguageHelper::all_languages();
        // foreach ($all_languages as $lang){
        //     foreach ($static_fields as $field){
        //         \App\StaticOption::updateOrCreate([
        //             'option_name' => str_replace('[lang]',$lang->slug,$field['option_name'])
        //         ],[
        //             'option_name' => str_replace('[lang]',$lang->slug,$field['option_name']),
        //             'option_value' => $field['option_value'],
        //         ]);
        //     }
        // }
    }
}
