<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\LanguageHelper;
use App\Helpers\NexelitHelpers;
use App\Http\Controllers\Controller;
use App\Traits\EmailTemplateHelperTrait;
use Illuminate\Http\Request;

class AppointmentEmailTempalteController extends Controller
{
    use EmailTemplateHelperTrait;
    const BASE_PATH = 'backend.email-template.appointment.';


    public function appointment_reminder_mail(){
        return view(self::BASE_PATH.'reminder-mail')->with(['all_languages' => LanguageHelper::all_languages()]);
    }
    public function update_appointment_reminder_mail(Request $request){
        $this->save_data('appointment_reminder_mail_',$request);
        return back()->with(NexelitHelpers::settings_update());
    }

    public function appointment_payment_accept(){
        return view(self::BASE_PATH.'payment-accept')->with(['all_languages' => LanguageHelper::all_languages()]);
    }

    public function update_appointment_payment_accept(Request $request){
        $this->save_data('appointment_payment_accept_',$request);
        return back()->with(NexelitHelpers::settings_update());
    }

    public function appointment_booking_admin(){
        return view(self::BASE_PATH.'booking-admin')->with(['all_languages' => LanguageHelper::all_languages()]);
    }

    public function update_appointment_booking_admin(Request $request){
        $this->save_data('appointment_booking_admin_',$request);
        return back()->with(NexelitHelpers::settings_update());
    }

    public function appointment_booking_update(){
        return view(self::BASE_PATH.'booking-update')->with(['all_languages' => LanguageHelper::all_languages()]);
    }
    public function update_appointment_booking_update(Request $request){
        $this->save_data('appointment_booking_update_',$request);
        return back()->with(NexelitHelpers::settings_update());
    }

    public function appointment_booking_user(){
        return view(self::BASE_PATH.'booking-user')->with(['all_languages' => LanguageHelper::all_languages()]);
    }

    public function update_appointment_booking_user(Request $request){
        $this->save_data('appointment_booking_user_',$request);
        return back()->with(NexelitHelpers::settings_update());
    }
}
