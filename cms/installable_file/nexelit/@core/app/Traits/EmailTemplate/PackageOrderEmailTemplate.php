<?php

namespace App\Traits\EmailTemplate;

use App\Helpers\LanguageHelper;
use App\PaymentLogs;
use App\PricePlan;

trait PackageOrderEmailTemplate
{
    /**
     * send packageOrderReminderMail
     * */
    public function packageOrderReminderMail($order_details)
    {
        $message = get_static_option('package_order_reminder_mail_' . LanguageHelper::user_lang_slug() . '_message');
        $message = $this->parsePackageInfo($message, $order_details);

        return [
            'subject' => get_static_option('package_order_reminder_mail_' . LanguageHelper::user_lang_slug() . '_subject'),
            'message' => $message
        ];
    }
    /**
     * send packageOrderPaymentApproveMail
     * */
    public function packageOrderPaymentApproveMail($order_details)
    {
        $message = get_static_option('package_order_payment_accept_' . LanguageHelper::user_lang_slug() . '_message');
        $message = $this->parsePackageInfo($message, $order_details);

        return [
            'subject' => get_static_option('package_order_payment_accept_' . LanguageHelper::user_lang_slug() . '_subject'),
            'message' => $message
        ];
    }

    /**
     * send packageOrderStatusChangeMail
     * */
    public function packageOrderStatusChangeMail($order_details)
    {
        $message = get_static_option('package_order_status_change_' . LanguageHelper::user_lang_slug() . '_message');
        $message = $this->parsePackageInfo($message, $order_details);

        return [
            'subject' => get_static_option('package_order_status_change_' . LanguageHelper::user_lang_slug() . '_subject'),
            'message' => $message
        ];
    }

    /**
     * send packageOrderUserMail
     * */
    public function packageOrderUserMail($order_details)
    {
        $message = get_static_option('package_order_user_mail_' . LanguageHelper::user_lang_slug() . '_message');
        $message = $this->parsePackageInfo($message, $order_details);

        return [
            'subject' => get_static_option('package_order_user_mail_' . LanguageHelper::user_lang_slug() . '_subject'),
            'message' => $message,
            'attachments' => unserialize($order_details->attachment,['class' => false])
        ];
    }

    /**
     * send packageOrderAdminMail
     * */
    public function packageOrderAdminMail($order_details)
    {
        $message = get_static_option('package_order_admin_mail_' . LanguageHelper::user_lang_slug() . '_message');
        $message = $this->parsePackageInfo($message, $order_details);

        return [
            'subject' => get_static_option('package_order_admin_mail_' . LanguageHelper::user_lang_slug() . '_subject'),
            'message' => $message,
            'attachments' => unserialize($order_details->attachment,['class' => false])
        ];
    }

    private function parsePackageInfo($message, $order_details)
    {
        $message = str_replace(
            [
                '@order_price_plan',
                '@order_billing_info',
                '@payment_status',
                '@order_id',
                '@order_payment_gateway',
                '@order_date',
                '@billing_name',
                '@billing_email',
                '@site_title',
                '@order_status',
                '@user_dashboard',
            ],
            [
                $this->orderPricePlan($order_details),
                $this->orderBillingInfo($order_details),
                $order_details->payment_status,
                $order_details->id,
                optional($order_details->package)->package_gateway,
                $order_details->created_at->format('d F Y H:m:s'),
                optional($order_details->package)->name,
                optional($order_details->package)->email,
                get_static_option('site_' . LanguageHelper::user_lang_slug() . '_title'),
                $order_details->status,
                ' <a href="'.route('user.home').'">'.__('your dashboard').'</a>'
            ], $message);
        return $message;
    }

    private function orderPricePlan($order_details)
    {
        $payment_details = PricePlan::where('id', $order_details->package_id)->first();
        $package_title = $payment_details->title;
        $package_type = $payment_details->type;
        $package_price = amount_with_currency_symbol($payment_details->price);
        $feature_markup  = '';
        $features = explode("\n",$payment_details->features);
        foreach($features as $item){
            $feature_markup .= '<li>'.$item.'</li>';
        }

        $output = <<<HTML
        <div class="price-plan-wrap">
                <div class="single-price-plan-01 style-02 active">
                    <div class="price-header">
                        <div class="name-box">
                            <h4 class="name">{$package_title}</h4>
                        </div>
                        <div class="price-wrap">
                            <span class="price">{$package_price}</span><span class="month">{$package_type}</span>
                        </div>
                    </div>
                    <div class="price-body">
                        <ul>
                            {$feature_markup}
                        </ul>
                    </div>
                </div>
            </div>
HTML;
        return $output;
    }

    private function orderBillingInfo($order_details)
    {
        $payment_details = PaymentLogs::where('order_id', $order_details->id)->first();

        $output = '<div class="billing-wrap">';
        $output .= '<ul class="billing-details">';
        $output .= '<li><strong>'.__('Order ID').':</strong> #'.$order_details->id.'</li>';
        $output .= '<li><strong>'.__('Name').':</strong> '.$payment_details->name.'</li>';
        $output .= '<li><strong>'.__('Email').':</strong> '.$payment_details->email.'</li>';
        $output .= '<li><strong>'.__('Payment Method').':</strong> '.str_replace('_',' ',$payment_details->package_gateway).'</li>';
        $output .= '<li><strong>'.__('Payment Status').':</strong> '.$payment_details->status.'</li>';
        $output .= '<li><strong>'.__('Transaction id').':</strong> '.$payment_details->transaction_id.'</li>';
        $output .= '</ul>';
        $output .= '</div>';

        return $output;
    }



}