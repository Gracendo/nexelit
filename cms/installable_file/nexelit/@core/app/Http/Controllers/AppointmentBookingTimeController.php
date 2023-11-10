<?php

namespace App\Http\Controllers;

use App\AppointmentBookingTime;
use Illuminate\Http\Request;

class AppointmentBookingTimeController extends Controller
{
    public function booking_time_all()
    {
        $all_booking_time = AppointmentBookingTime::all();
        return view('backend.appointment.appointment-booking-time')->with(['all_booking_time' => $all_booking_time]);
    }

    public function booking_time_new(Request $request)
    {
        $this->validate($request,[
           'time' => 'required|string',
           'status' => 'required|string'
        ]);
        AppointmentBookingTime::create([
            'time' => $request->time,
            'status' => $request->status
        ]);
        return back()->with([
            'msg' => __('New Item Added'),
            'type' => 'success'
        ]);
    }

    public function booking_time_update(Request $request){
        $this->validate($request,[
            'time' => 'required|string',
            'status' => 'required|string'
        ]);
        AppointmentBookingTime::findOrFail($request->id)->update([
            'time' => $request->time,
            'status' => $request->status
        ]);
        return back()->with([
            'msg' => __('Item updated'),
            'type' => 'success'
        ]);
    }

    public function booking_time_delete(Request $request){
        AppointmentBookingTime::findOrFail($request->id)->delete();
        return back()->with([
            'msg' => __('item deleted'),
            'type' => 'danger'
        ]);
    }

    public function booking_bulk_action(Request $request){
        AppointmentBookingTime::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
