<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\LanguageHelper;
use App\Helpers\NexelitHelpers;
use App\Http\Controllers\Controller;
use App\Traits\EmailTemplateHelperTrait;
use Illuminate\Http\Request;

class PackageOrderEmailTemplateController extends Controller
{

    use EmailTemplateHelperTrait;
    const BASE_PATH = 'backend.email-template.package-order.';

    public function package_order_status_change(){
        return view(self::BASE_PATH.'status-change')->with(['all_languages' => LanguageHelper::all_languages()]);
    }
    public function package_order_admin(){
        return view(self::BASE_PATH.'admin-mail')->with(['all_languages' => LanguageHelper::all_languages()]);
    }
    public function package_order_user(){
        return view(self::BASE_PATH.'user-mail')->with(['all_languages' => LanguageHelper::all_languages()]);
    }
    public function package_order_payment_accept(){
        return view(self::BASE_PATH.'payment-accept')->with(['all_languages' => LanguageHelper::all_languages()]);
    }
    public function package_order_reminder_mail(){
        return view(self::BASE_PATH.'reminder-mail')->with(['all_languages' => LanguageHelper::all_languages()]);
    }
    public function update_package_order_reminder_mail(Request $request){
        $this->save_data('package_order_reminder_mail_',$request);
        return back()->with(NexelitHelpers::settings_update());
    }
    public function update_package_order_payment_accept(Request $request){
        $this->save_data('package_order_payment_accept_',$request);
        return back()->with(NexelitHelpers::settings_update());
    }
    public function update_package_order_status_change(Request $request){
        $this->save_data('package_order_status_change_',$request);
        return back()->with(NexelitHelpers::settings_update());
    }
    public function update_package_order_user(Request $request){
        $this->save_data('package_order_user_mail_',$request);
        return back()->with(NexelitHelpers::settings_update());
    }
    public function update_package_order_admin(Request $request){
        $this->save_data('package_order_admin_mail_',$request);
        return back()->with(NexelitHelpers::settings_update());
    }
}
