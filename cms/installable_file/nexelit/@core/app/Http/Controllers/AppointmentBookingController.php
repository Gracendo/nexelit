<?php

namespace App\Http\Controllers;

use App\AppointmentBooking;
use App\AppointmentBookingTime;
use App\Facades\EmailTemplate;
use App\Helpers\NexelitHelpers;
use App\Mail\BasicMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AppointmentBookingController extends Controller
{
    public $base_path = 'backend.appointment.';
    public function booking_all(){
        $all_booking = AppointmentBooking::orderBy('id','desc')->get();
        $all_booking_time = AppointmentBookingTime::where('status','publish')->get();
        return view($this->base_path.'appointment-booking-all')->with(['all_booking' => $all_booking,'all_booking_time' => $all_booking_time]);
    }

    public function bulk_action(Request $request){
        $all = AppointmentBooking::find($request->ids);
        foreach($all as $item){
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }
    public function booking_delete($id){
        AppointmentBooking::findOrFail($id)->delete();
        return back()->with([
           'msg' => __('Delete Success'),
            'type' => 'danger'
        ]);
    }

    public function approve_payment($id){
        AppointmentBooking::findOrFail($id)->update([
           'payment_status' => 'complete',
           'status' => 'confirm'
        ]);

        $booking_details = AppointmentBooking::findOrFail($id);
        try {
            Mail::to($booking_details->email)->send(new BasicMail(EmailTemplate::appointmentPaymentAcceptMail($booking_details)));
        }catch (\Exception $e){
            return back()->with(NexelitHelpers::item_delete(__('Payment Approved, Mail send Faild for').' '.$e->getMessage()));
        }

        return back()->with([
            'msg' => __('Payment Approved'),
            'type' => 'success'
        ]);
    }

    public function reminder_mail(Request $request){

        $booking_details = AppointmentBooking::findOrFail($request->id);
        try {
            Mail::to($booking_details->email)->send(new BasicMail(EmailTemplate::appointmentReminderMail($booking_details)));
        }catch (\Exception $e){
            return back()->with(NexelitHelpers::item_delete($e->getMessage()));
        }


        return back()->with([
            'msg' => __('Reminder mail send'),
            'type' => 'success'
        ]);
    }

    public function booking_view($id){
        $booking_details = AppointmentBooking::findOrFail($id);
        return view($this->base_path.'appointment-booking-view')->with(['booking_details' => $booking_details]);
    }

    public function booking_update(Request $request){
        $booking_details = AppointmentBooking::findOrFail($request->id);
       $booking_details->booking_time_id = $request->booking_time_id;
        $booking_details->booking_date = $request->booking_date;
        $booking_details->save();

        try {
            $booking_details = AppointmentBooking::findOrFail($request->id);
            Mail::to($booking_details->email)->send(new BasicMail(EmailTemplate::appointmentBookingUpdateMail($booking_details)));
        }catch (\Exception $e){
            return back()->with(NexelitHelpers::item_delete(__('Booking date and time updated, mail send failed').' '.$e->getMessage()));
        }

        return back()->with([
            'msg' => __('Booking date and time updated'),
            'type' => 'success'
        ]);
    }

}
