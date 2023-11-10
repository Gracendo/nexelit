<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\LanguageHelper;
use App\Helpers\NexelitHelpers;
use App\Http\Controllers\Controller;
use App\Traits\EmailTemplateHelperTrait;
use Illuminate\Http\Request;

class CourseEmailTemplateController extends Controller
{
    use EmailTemplateHelperTrait;
    const BASE_PATH = 'backend.email-template.course.';

    public function course_enroll_admin(){
        return view(self::BASE_PATH.'enroll-admin')->with(['all_languages' => LanguageHelper::all_languages()]);
    }

    public function course_enroll_user(){
        return view(self::BASE_PATH.'enroll-user')->with(['all_languages' => LanguageHelper::all_languages()]);
    }

    public function course_payment_accept(){
        return view(self::BASE_PATH.'payment-accept')->with(['all_languages' => LanguageHelper::all_languages()]);
    }
    public function course_reminder_mail(){
        return view(self::BASE_PATH.'reminder-mail')->with(['all_languages' => LanguageHelper::all_languages()]);
    }

    public function update_courese_enroll_admin(Request $request){
        $this->save_data('course_enroll_admin_',$request);

        return back()->with(NexelitHelpers::settings_update());
    }

    public function update_course_enroll_user(Request $request){
        $this->save_data('course_enroll_user_',$request);

        return back()->with(NexelitHelpers::settings_update());
    }
    public function update_course_payment_accept(Request $request){
        $this->save_data('course_payment_accept_',$request);

        return back()->with(NexelitHelpers::settings_update());
    }
    public function update_course_reminder_mail(Request $request){
        $this->save_data('course_reminder_mail_',$request);

        return back()->with(NexelitHelpers::settings_update());
    }
}
