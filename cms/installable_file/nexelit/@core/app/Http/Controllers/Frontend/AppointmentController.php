<?php

namespace App\Http\Controllers\Frontend;

use App\Appointment;
use App\AppointmentBooking;
use App\AppointmentBookingTime;
use App\AppointmentCategory;
use App\AppointmentLang;
use App\AppointmentReview;
use App\Course;
use App\CourseCoupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public $base_path = 'frontend.pages.appointment.';
    public function single($slug,$id){
        $item = Appointment::with('lang_front')->findOrFail( $id);
        return view($this->base_path.'single')->with(['item' =>$item]);
    }
    public function review(Request $request){
        $this->validate($request,[
            'appointment_id' => 'required|numeric',
            'ratings' => 'required|numeric',
            'message' => 'required|string'
        ],[
            'ratings.required' => __('rating required'),
            'message.required' => __('message required'),
        ]);

        $user_id = auth()->guard('web')->user()->id;

        $is_purchased = AppointmentBooking::where(['appointment_id' => $request->appointment_id,'user_id' => $user_id])->first();
        $old_review = AppointmentReview::where(['appointment_id' => $request->appointment_id,'user_id' => $user_id])->first();
        $data['type'] = 'danger';
        $data['msg'] = __('you have not used this service, you cannot leave feedback');

        if (!empty($is_purchased) && empty($old_review)){
            AppointmentReview::create([
                'user_id' => $user_id ?? null,
                'appointment_id' => $request->appointment_id,
                'message' => $request->message,
                'ratings' => $request->ratings
            ]);
            $data['type'] = 'success';
            $data['msg'] = __('thanks for your feedback');
        }
        if (!empty($old_review)){
            $data['msg'] = __('you have already given your feedback');
        }
        return response()->json($data);
    }

    public function payment_success($id){
        $extract_id = substr($id,6);
        $extract_id =  substr($extract_id,0,-6);
        $appointment_booking = AppointmentBooking::findOrFail($extract_id);
        return view($this->base_path .'payment-success')->with(['booking' =>$appointment_booking]);
    }
    public function payment_cancel($id){
        $extract_id = substr($id,6);
        $extract_id =  substr($extract_id,0,-6);
        $appointment_booking = AppointmentBooking::findOrFail($extract_id);
        return view($this->base_path .'payment-cancel')->with(['booking' =>$appointment_booking]);
    }

    public function page(Request $request){
        $user_lang  = get_user_lang();
        $sort = $request->sort ?? '';
        $cat_id = $request->cat ?? '';
        $search_term = $request->s ?? '';
        $appointment_query = Appointment::query();
        $appointment_query->with('lang_front')->where(['status' => 'publish']);
        $sort_by = 'id';
        $sorting = 'desc';

        if (!empty($search_term)){
            $appointment_lang_ids = AppointmentLang::where('title','LIKE','%'.$search_term.'%')->pluck('appointment_id');
            $appointment_query->whereIn('id',$appointment_lang_ids);
        }

        if (!empty($cat_id)){
            $appointment_query->where('categories_id' ,$cat_id);
        }
        //implement search features
        if (!empty($sort)){
            switch ($sort){
                case('oldest'):
                    $sort_by = 'id';
                    $sorting = 'asc';
                    break;
                case('top_rated'):
                    $all_rated_appointment = AppointmentBooking::orderBy('ratings','desc')->get('appointment_id')->toArray();
                    $appointment_query->whereIn('id',array_unique($all_rated_appointment));
                    $sort_by = 'id';
                    $sorting = 'asc';
                    break;
                case('low_price'):
                    $sort_by = 'price';
                    $sorting = 'asc';
                    break;
                case('high_price'):
                    $sort_by = 'price';
                    $sorting = 'desc';
                    break;
                default:
                    $sort_by = 'id';
                    $sorting = 'desc';
                    break;
            }
        }
        $appointment_query->orderBy($sort_by,$sorting);

        $all_appointment = $appointment_query->paginate(9);

        $category_list = AppointmentCategory::with('lang_front')->where(['status' => 'publish'])->get();
        return view($this->base_path.'appointment-all')->with([
            'all_appointment'=>$all_appointment,
            'sort'=>$sort,
            'category_list' => $category_list,
            'cat_id' => $cat_id,
            'search_term' => $search_term,
        ]);
    }

    public function category($id){
        $cat_name = AppointmentCategory::with('lang_front')->findOrFail($id)->lang_front->title;
        $all_appointment = Appointment::with('lang_front')->where(['status' => 'publish','categories_id' => $id])->orderBy('id','desc')->paginate(9);
        return view($this->base_path.'appointment-category')->with(['cat_name'=>$cat_name,'all_appointment' => $all_appointment]);
    }
    
    public function appointment_booking_time_check(Request $request){

            $appointment_details = Appointment::find($request->appointment_id);

            $all_booking = AppointmentBooking::where(['appointment_id' => $request->appointment_id,'booking_date' => $request->date ])->get();
            $all_booking_time = AppointmentBookingTime::get();
            
            if( $all_booking->count() >= 1){
                // has some booking int this date
                //check for maximum appointment 
                $allboking_time_array = $all_booking->pluck('booking_time_id')->toArray();
                $all_booking_time = $all_booking_time->map(function($item) use ($allboking_time_array){
                    return !in_array($item->id,$allboking_time_array) ? $item : false;
                });
            
            }
            return response()->json([
                'existing_booking_item' => $all_booking,
                'available_booking_time' => $all_booking_time,
                'requested_booking_date' => $request->date
                ]
            );
    }

}
