<?php

namespace App\Http\Controllers\Admin;

use App\CourseCertificate;
use App\Helpers\NexelitHelpers;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CourseCertificateController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin');
    }

    public function all(){
        $all_certificates = CourseCertificate::all();
        return view('backend.courses.certificate.index',compact('all_certificates'));
    }

    public function delete($id){
        CourseCertificate::find($id)->delete();
        return back()->with(NexelitHelpers::item_delete());
    }

    public function bulk_action(Request $request){
        CourseCertificate::whereIn('id',$request->ids)->delete();
        return back()->with(NexelitHelpers::item_delete());
    }

    public function approved(Request $request){

        $this->validate($request,[
           'course_id' => 'required',
           'user_id' => 'required',
        ]);

        CourseCertificate::where(['course_id' => $request->course_id,'user_id' => $request->user_id])->update([
            'status' => 1
        ]);

        return back()->with(NexelitHelpers::settings_update(__('Certificate Request Approve..')));
    }

    public function download($id){
        $course_certificate = CourseCertificate::with(['course','user'])->find($id);
        abort_if(is_null($course_certificate),404);
        $pdf = PDF::loadView('certificate.course', ['course_certificate' => $course_certificate])->setPaper('a4', 'landscape');
        return $pdf->download('certificate'.Str::random(10).'.pdf');
    }

}
