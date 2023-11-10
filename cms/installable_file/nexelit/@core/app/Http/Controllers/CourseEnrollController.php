<?php

namespace App\Http\Controllers;

use App\CourseEnroll;
use App\Facades\EmailTemplate;
use App\Helpers\NexelitHelpers;
use App\Mail\BasicMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CourseEnrollController extends Controller
{
    public function all(){
        $all_enroll = CourseEnroll::all();
        return view('backend.courses.enroll-all')->with(['all_enroll' => $all_enroll]);
    }

    public function delete($id){
        CourseEnroll::findOrFail($id)->delete();
        return back()->with(NexelitHelpers::item_delete());
    }

    public function reminder(Request $request){
        $enroll_details = CourseEnroll::findOrFail($request->id);
        try {
            Mail::to($enroll_details->email)->send(new BasicMail(EmailTemplate::courseReminderMail($enroll_details)));
        }catch (\Exception $e){
            return back()->with(NexelitHelpers::item_delete($e->getMessage()));
        }

        return back()->with(NexelitHelpers::reminder_mail());
    }

    public function bulk_action(Request $request){
        CourseEnroll::whereIn('id',$request->ids)->delete();
        return response()->json(['ok']);
    }
    public function payment_approved($id){

        $enroll_details = CourseEnroll::findOrFail($id);
        $enroll_details->payment_status = 'complete';
        $enroll_details->status = 'complete';
        $enroll_details->save();

        $email = $enroll_details->email;
        try {
            Mail::to($email)->send(new BasicMail(EmailTemplate::coursePaymentAcceptMail($enroll_details)));
        }catch (\Exception $e){
            return back()->with(NexelitHelpers::item_delete($e->getMessage()));
        }

        return back()->with(NexelitHelpers::payment_approved());
    }

    public function view($id){
        $enroll_details = CourseEnroll::findOrFail($id);
        return view('backend.courses.course-enroll-view')->with(['enroll_details' => $enroll_details]);
    }
}
