<?php

namespace App\Http\Controllers;

use App\Actions\SlugChecker;
use App\Appointment;
use App\AppointmentBooking;
use App\AppointmentBookingTime;
use App\AppointmentCategory;
use App\AppointmentLang;
use App\CourseLang;
use App\Feedback;
use App\Helpers\NexelitHelpers;
use App\Http\Requests\SlugCheckRequest;
use App\Language;
use App\Mail\FeedbackMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AppointmentController extends Controller
{
    //appointment_all
    public $base_view_path = 'backend.appointment.';
    public $languages;

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->languages = Language::all();
    }

    public function appointment_all()
    {
        $all_appointment = Appointment::with('lang')->get();
        return view($this->base_view_path . 'appointment-all')->with(['all_appointment' => $all_appointment]);
    }

    public function appointment_new()
    {
        $all_booking_time = AppointmentBookingTime::where('status' , 'publish')->get();
        $all_category = AppointmentCategory::with('lang')->where(['status' => 'publish'])->get();
        return view($this->base_view_path . 'appointment-new')->with([
            'all_languages' => $this->languages,
            'all_booking_time' => $all_booking_time,
            'all_category' => $all_category,
        ]);
    }

    public function category_by_lang(Request $request){
        $data = AppointmentCategory::where(['status' => 'publish', 'lang' => $request->lang])->get();
        return response()->json($data);
    }

    public function appointment_store(Request $request){
        $this->validate($request,[
            'title' => 'check_array:1',
            'slug' => 'nullable|array|max:191',
            'designation' => 'nullable|array|max:191',
            'category_id' => 'required|string|max:191',
            'booking_time_ids' => 'required|string|max:191',
            'description' => 'nullable|array',
            'max_appointment' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'short_description' => 'nullable|array',
            'meta_title' => 'nullable|array',
            'meta_tags' => 'nullable|array',
            'meta_description' => 'nullable|array',
            'image' => 'nullable|string',
            'status' => 'required|string',
            'appointment_status' => 'nullable|string',
            'additional_info' => 'nullable|array',
            'experience_info' => 'nullable|array',
            'specialized_info' => 'nullable|array',
        ]);


        DB::beginTransaction();

        try {
            $appointment_id = Appointment::create([
                'categories_id' => $request->category_id,
                'booking_time_ids' => $request->booking_time_ids,
                'status' => $request->status,
                'appointment_status' => $request->appointment_status,
                'image' => $request->image,
                'max_appointment' => $request->max_appointment,
                'price' => $request->price,
            ])->id;

            foreach ($this->languages as $lang){
                AppointmentLang::create([
                    'appointment_id' => $appointment_id,
                    'description' => $request->description[$lang->slug] ?? '',
                    'additional_info' => $request->additional_info[$lang->slug] ?? [],
                    'experience_info'=> $request->experience_info[$lang->slug] ?? [],
                    'specialized_info'=> $request->specialized_info[$lang->slug] ?? [],
                    'location' => $request->location[$lang->slug] ?? '',
                    'meta_description' => $request->meta_description[$lang->slug] ?? '',
                    'meta_title' => $request->meta_title[$lang->slug] ?? '',
                    'meta_tags' => $request->meta_tags[$lang->slug] ?? '',
                    'slug' => $request->slug[$lang->slug] ?? '',
                    'short_description' => $request->short_description[$lang->slug] ?? '',
                    'lang' => $lang->slug,
                    'title' => $request->title[$lang->slug] ?? '',
                    'designation' => $request->designation[$lang->slug] ?? '',
                ]);
            }
             DB::commit();

        }catch (\Throwable $e){
            report($e);
        }

        return back()->with(NexelitHelpers::item_new());
    }

    public function appointment_delete(Request $request,$id){
        Appointment::findOrFail($id)->delete();
        AppointmentLang::where('appointment_id',$id)->delete();
        return back()->with(NexelitHelpers::item_delete());
    }
    public function appointment_edit($id){
        $edit_items = Appointment::with('lang_all')->findOrFail($id);
        $all_booking_time = AppointmentBookingTime::where('status','publish')->get();
        $all_category = AppointmentCategory::where(['status' => 'publish'])->get();
        $item_langs = $edit_items->lang_all->pluck('lang')->toArray();
        foreach ($this->languages as $lang){
            if (!in_array($lang->slug,$item_langs)){
                AppointmentLang::create([
                    'appointment_id' => $edit_items->id,
                    'description' => '',
                    'additional_info' => [],
                    'experience_info'=>  [],
                    'specialized_info'=>  [],
                    'location' =>  '',
                    'meta_description' =>  '',
                    'meta_title' => '',
                    'meta_tags' =>'',
                    'slug' => '',
                    'short_description' => '',
                    'lang' => $lang->slug,
                    'title' => '',
                    'designation' =>  '',
                ]);
            }

        }
        return view($this->base_view_path.'appointment-edit')->with([
            'item' => $edit_items,
            'all_languages' => $this->languages,
            'all_booking_time' => $all_booking_time,
            'all_category' => $all_category,
        ]);
    }

    public function appointment_update(Request $request){
        $this->validate($request,[
            'title' => 'check_array:1',
            'slug' => 'nullable|array|max:191',
            'designation' => 'nullable|array|max:191',
            'category_id' => 'required|string|max:191',
            'booking_time_ids' => 'required|string|max:191',
            'description' => 'nullable|array',
            'max_appointment' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'short_description' => 'nullable|array',
            'meta_title' => 'nullable|array',
            'meta_tags' => 'nullable|array',
            'meta_description' => 'nullable|array',
            'image' => 'nullable|string',
            'status' => 'required|string',
            'appointment_status' => 'nullable|string',
            'additional_info' => 'nullable|array',
            'experience_info' => 'nullable|array',
            'specialized_info' => 'nullable|array',
        ],[
            'title.check_array' => __('title required'),
        ]);

        DB::beginTransaction();

        try {
            Appointment::findOrFail($request->id)->update([
                'categories_id' => $request->category_id,
                'booking_time_ids' => $request->booking_time_ids,
                'status' => $request->status,
                'appointment_status' => $request->appointment_status,
                'image' => $request->image,
                'max_appointment' => $request->max_appointment,
                'price' => $request->price,
            ]);

            foreach ($this->languages as $lang){
                AppointmentLang::where(['lang' => $lang->slug,'appointment_id'=>$request->id])->update([
                    'description' => $request->description[$lang->slug] ?? '',
                    'additional_info' =>serialize( $request->additional_info[$lang->slug] ?? []),
                    'experience_info'=> serialize($request->experience_info[$lang->slug] ?? []),
                    'specialized_info'=> serialize($request->specialized_info[$lang->slug] ?? []),
                    'location' => $request->location[$lang->slug] ?? '',
                    'meta_description' => $request->meta_description[$lang->slug] ?? '',
                    'meta_title' => $request->meta_title[$lang->slug] ?? '',
                    'meta_tags' => $request->meta_tags[$lang->slug] ?? '',
                    'slug' => $request->slug[$lang->slug] ?? '',
                    'short_description' => $request->short_description[$lang->slug] ?? '',
                    'title' => $request->title[$lang->slug] ?? '',
                    'designation' => $request->designation[$lang->slug] ?? '',
                ]);
            }
            DB::commit();

        }catch (\Throwable $e){
            report($e);
        }

        return back()->with(NexelitHelpers::item_update());
    }

    public function appointment_clone(Request $request){

        $appointment = Appointment::findOrFail($request->id);


        DB::beginTransaction();
        try {
            DB::commit();
        }catch (\Throwable $e){
            report($e);
        }
        $appointment_id = Appointment::create([
            'categories_id' => $appointment->categories_id,
            'booking_time_ids' => implode(',',array_column($appointment->booking_time_ids,'id')),
            'status' => 'draft',
            'appointment_status' => $appointment->appointment_status,
            'image' => $appointment->image,
            'max_appointment' => $appointment->max_appointment,
            'price' => $appointment->price,
        ])->id;

        foreach ($this->languages as $lang){
            $appointment_lang = AppointmentLang::where(['appointment_id' => $request->id, 'lang' => $lang->slug])->first();
            AppointmentLang::create([
                'appointment_id' => $appointment_id,
                'description' => $appointment_lang->description ?? '',
                'additional_info' => $appointment_lang->additional_info ,
                'experience_info'=> $appointment_lang->experience_info,
                'specialized_info'=> $appointment_lang->specialized_info,
                'location' => $appointment_lang->location ?? '',
                'meta_description' => $appointment_lang->meta_description ?? '',
                'meta_title' => $appointment_lang->meta_title ?? '',
                'meta_tags' => $appointment_lang->meta_tags ?? '',
                'slug' => $appointment_lang->slug ?? '',
                'short_description' => $appointment_lang->short_description ?? '',
                'lang' => $lang->slug,
                'title' => $appointment_lang->title ?? '',
                'designation' => $appointment_lang->designation ?? '',
            ]);
        }

        return back()->with(NexelitHelpers::item_clone());
    }

    public function bulk_action(Request $request){
        Appointment::whereIn('id',$request->ids)->delete();
        AppointmentLang::whereIn('appointment_id',$request->ids)->delete();

        return response()->json(['status' => 'ok']);
    }

    public function form_builder(){
        return view($this->base_view_path.'appointment-booking-form');
    }
    public function form_builder_save(Request $request){
        $this->validate($request,[
            'field_name' => 'required|max:191',
            'field_placeholder' => 'required|max:191',
        ]);
        unset($request['_token']);
        $all_fields_name = [];
        $all_request_except_token = $request->all();
        foreach ($request->field_name as $fname){
            $all_fields_name[] = strtolower(Str::slug($fname));
        }
        $all_request_except_token['field_name'] = $all_fields_name;
        $json_encoded_data = json_encode($all_request_except_token);

        update_static_option('appointment_booking_page_form_fields',$json_encoded_data);
        return redirect()->back()->with(['msg' => __('Form Updated...'),'type' => 'success']);
    }

    public function settings(){
        return view($this->base_view_path.'appointment-settings')->with(['all_languages' => $this->languages]);
    }

    public function settings_save(Request $request){
        $this->validate($request,[
            'appointment_notify_mail' => 'required|email|max:191',
            'disable_guest_mode_for_appointment_module' => 'nullable|string',
        ]);
        foreach ($this->languages as $lang){
            $this->validate($request,[
                'appointment_single_'.$lang->slug.'_information_tab_title' => 'nullable|string',
                'appointment_single_'.$lang->slug.'_booking_tab_title' => 'nullable|string',
                'appointment_single_'.$lang->slug.'_feedback_tab_title' => 'nullable|string',
                'appointment_single_'.$lang->slug.'_appointment_booking_information_text' => 'nullable|string',
                'appointment_single_'.$lang->slug.'_appointment_booking_button_text' => 'nullable|string',
                'appointment_single_'.$lang->slug.'_appointment_booking_about_me_title' => 'nullable|string',
                'appointment_single_'.$lang->slug.'_appointment_booking_educational_info_title' => 'nullable|string',
                'appointment_single_'.$lang->slug.'_appointment_booking_additional_info_title' => 'nullable|string',
                'appointment_single_'.$lang->slug.'_appointment_booking_client_feedback_title' => 'nullable|string',
                'appointment_single_'.$lang->slug.'_appointment_booking_specialize_info_title' => 'nullable|string',
                'appointment_booking_'.$lang->slug.'_success_page_title' => 'nullable|string',
                'appointment_booking_'.$lang->slug.'_success_page_description' => 'nullable|string',
                'appointment_booking_'.$lang->slug.'_cancel_page_title' => 'nullable|string',
                'appointment_booking_'.$lang->slug.'_cancel_page_description' => 'nullable|string',
            ]);
            $fields_list = [
                'appointment_single_'.$lang->slug.'_information_tab_title',
                'appointment_single_'.$lang->slug.'_booking_tab_title',
                'appointment_single_'.$lang->slug.'_feedback_tab_title' ,
                'appointment_single_'.$lang->slug.'_appointment_booking_information_text',
                'appointment_single_'.$lang->slug.'_appointment_booking_button_text' ,
                'appointment_single_'.$lang->slug.'_appointment_booking_about_me_title' ,
                'appointment_single_'.$lang->slug.'_appointment_booking_educational_info_title',
                'appointment_single_'.$lang->slug.'_appointment_booking_additional_info_title',
                'appointment_single_'.$lang->slug.'_appointment_booking_specialize_info_title',
                'appointment_single_'.$lang->slug.'_appointment_booking_client_feedback_title',
                'appointment_booking_'.$lang->slug.'_success_page_title',
                'appointment_booking_'.$lang->slug.'_success_page_description',
                'appointment_booking_'.$lang->slug.'_cancel_page_title',
                'appointment_booking_'.$lang->slug.'_cancel_page_description',
                'appointment_page_'.$lang->slug.'_booking_button_text'
            ];

            foreach ($fields_list as $field){
                update_static_option($field,$request->$field);
            }
        }

        update_static_option('disable_guest_mode_for_appointment_module',$request->disable_guest_mode_for_appointment_module);
        update_static_option('appointment_notify_mail',$request->appointment_notify_mail);
        return back()->with([
            'msg' => __('Settings Updated'),
            'type' => 'success'
        ]);
    }

    public function slug_check(SlugCheckRequest $request){

        $user_given_slug = $request->slug;
        $query = AppointmentLang::where(['slug' => $user_given_slug]);

        return SlugChecker::Check($request,$query);
    }
}
