<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\LanguageHelper;
use App\Helpers\NexelitHelpers;
use App\Http\Controllers\Controller;
use App\Traits\EmailTemplateHelperTrait;
use Illuminate\Http\Request;

class ProductEmailTemplateController extends Controller
{
    use EmailTemplateHelperTrait;
    const BASE_PATH = 'backend.email-template.products.';

    public function product_order_status_change_mail(){
        return view(self::BASE_PATH.'order-status-change')->with(['all_languages' => LanguageHelper::all_languages()]);
    }
    public function update_product_order_status_change_mail(Request $request){
        $this->save_data('product_order_status_change_mail_',$request);
        return back()->with(NexelitHelpers::settings_update());
    }

    public function product_order_mail_payment_accept(){
        return view(self::BASE_PATH.'order-payment-accept')->with(['all_languages' => LanguageHelper::all_languages()]);
    }
    public function update_product_order_mail_payment_accept(Request $request){
        $this->save_data('product_order_payment_accept_mail_',$request);
        return back()->with(NexelitHelpers::settings_update());
    }

    public function product_order_mail_reminder_mail(){
        return view(self::BASE_PATH.'order-reminder-mail')->with(['all_languages' => LanguageHelper::all_languages()]);
    }
    public function update_product_order_mail_reminder_mail(Request $request){
        $this->save_data('product_order_reminder_mail_',$request);
        return back()->with(NexelitHelpers::settings_update());
    }

     public function product_order_mail_admin(){
        return view(self::BASE_PATH.'order-mail-admin')->with(['all_languages' => LanguageHelper::all_languages()]);
    }
    public function update_product_order_mail_admin(Request $request){
        $this->save_data('product_order_admin_mail_',$request);
        return back()->with(NexelitHelpers::settings_update());
    }

    public function product_order_mail_user(){
        return view(self::BASE_PATH.'order-mail-user')->with(['all_languages' => LanguageHelper::all_languages()]);
    }
    public function update_product_order_mail_user(Request $request){
        $this->save_data('product_order_user_mail_',$request);
        return back()->with(NexelitHelpers::settings_update());
    }
}
