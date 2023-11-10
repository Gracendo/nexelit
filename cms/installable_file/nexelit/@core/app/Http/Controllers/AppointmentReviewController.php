<?php

namespace App\Http\Controllers;

use App\AppointmentReview;
use Illuminate\Http\Request;

class AppointmentReviewController extends Controller
{
    //appointment_all
    public $base_view_path = 'backend.appointment.';
    public function review_all(){
        $all_reviews = AppointmentReview::all();
        return view($this->base_view_path.'appointment-review-all')->with(['all_reviews' => $all_reviews]);
    }

    public function review_delete($id){
        AppointmentReview::findOrFail($id)->delete();
        return back()->with([
           'msg' => __('Update Success'),
           'type' => 'success'
        ]);
    }
}
