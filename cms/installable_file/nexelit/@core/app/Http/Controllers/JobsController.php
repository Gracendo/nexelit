<?php

namespace App\Http\Controllers;

use App\Helpers\NexelitHelpers;
use App\JobApplicant;
use App\Jobs;
use App\JobsCategory;
use App\Language;
use App\Mail\BasicMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class JobsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function all_jobs(){
        $all_jobs = Jobs::all()->groupBy('lang');
        return view('backend.jobs.all-jobs')->with(['all_jobs' => $all_jobs]);
    }

    public function edit_job($id){

        $job_post = Jobs::find($id);
        $all_category = JobsCategory::where(['status' => 'publish','lang' => $job_post->lang])->get();
        $all_language = Language::all();

        return view('backend.jobs.edit-job')->with([
            'all_languages' => $all_language,
            'all_category' => $all_category,
            'job_post' => $job_post
        ]);
    }

    public function new_job(){
        $all_category = JobsCategory::where(['status' => 'publish','lang' => get_default_language()])->get();
        $all_language = Language::all();
        return view('backend.jobs.new-job')->with(['all_languages' => $all_language,'all_category' => $all_category]);
    }

    public function store_job(Request $request){
        $this->validate($request,[
            'title' => 'required|string',
            'position' => 'required|string|max:191',
            'company_name' => 'required|string|max:191',
            'category_id' => 'required|string|max:191',
            'vacancy' => 'required|string|max:191',
            'job_responsibility' => 'required|string',
            'employment_status' => 'required|string',
            'education_requirement' => 'nullable|string',
            'job_context' => 'nullable|string',
            'experience_requirement' => 'nullable|string',
            'additional_requirement' => 'nullable|string',
            'job_location' => 'required|string',
            'salary' => 'required|string',
            'lang' => 'required|string|max:191',
            'other_benefits' => 'nullable|string',
            'email' => 'nullable|string|max:191',
            'status' => 'nullable|string|max:191',
            'deadline' => 'required|string|max:191',
            'meta_tags' => 'nullable|string|max:191',
            'meta_description' => 'nullable|string|max:191',
            'slug' => 'nullable|string|max:191',
        ]);
        $slug = !empty($request->slug) ? $request->slug : Str::slug($request->title,$request->lang);

        Jobs::create([
            'title' => $request->title,
            'position' => $request->position,
            'company_name' => $request->company_name,
            'category_id' => $request->category_id,
            'vacancy' => $request->vacancy,
            'job_responsibility' => $request->job_responsibility,
            'employment_status' => $request->employment_status,
            'education_requirement' => $request->education_requirement,
            'job_context' => $request->job_context,
            'experience_requirement' => $request->experience_requirement,
            'additional_requirement' => $request->additional_requirement,
            'job_location' => $request->job_location,
            'salary' => $request->salary,
            'lang' => $request->lang,
            'other_benefits' => $request->other_benefits,
            'email' => $request->email,
            'status' => $request->status,
            'deadline' => $request->deadline,
            'meta_tags' => $request->meta_tags,
            'meta_description' => $request->meta_description,
            'application_fee' => $request->application_fee,
            'application_fee_status' => $request->application_fee_status,
            'slug' => $slug,
        ]);

        return redirect()->back()->with(['msg' => __('New Job Post Added'),'type' => 'success']);
    }

    public function update_job(Request $request){
        $this->validate($request,[
            'title' => 'required|string',
            'position' => 'required|string|max:191',
            'company_name' => 'required|string|max:191',
            'category_id' => 'required|string|max:191',
            'vacancy' => 'required|string|max:191',
            'job_responsibility' => 'required|string',
            'employment_status' => 'required|string',
            'education_requirement' => 'nullable|string',
            'experience_requirement' => 'nullable|string',
            'additional_requirement' => 'nullable|string',
            'job_context' => 'nullable|string',
            'job_location' => 'required|string',
            'salary' => 'required|string',
            'lang' => 'required|string|max:191',
            'other_benefits' => 'nullable|string',
            'email' => 'nullable|string|max:191',
            'status' => 'nullable|string|max:191',
            'deadline' => 'required|string|max:191',
            'meta_tags' => 'nullable|string|max:191',
            'meta_description' => 'nullable|string|max:191',
            'slug' => 'nullable|string|max:191',
        ]);
        $slug = !empty($request->slug) ? $request->slug : Str::slug($request->title,$request->lang);

        Jobs::find($request->job_id)->update([
            'title' => $request->title,
            'position' => $request->position,
            'company_name' => $request->company_name,
            'category_id' => $request->category_id,
            'vacancy' => $request->vacancy,
            'job_responsibility' => $request->job_responsibility,
            'employment_status' => $request->employment_status,
            'education_requirement' => $request->education_requirement,
            'job_context' => $request->job_context,
            'experience_requirement' => $request->experience_requirement,
            'additional_requirement' => $request->additional_requirement,
            'job_location' => $request->job_location,
            'salary' => $request->salary,
            'lang' => $request->lang,
            'other_benefits' => $request->other_benefits,
            'email' => $request->email,
            'status' => $request->status,
            'deadline' => $request->deadline,
            'meta_tags' => $request->meta_tags,
            'meta_description' => $request->meta_description,
            'slug' => $slug,
            'application_fee' => $request->application_fee,
            'application_fee_status' => $request->application_fee_status,
        ]);

        return redirect()->back()->with(['msg' => __('Job Post Update Success...'),'type' => 'success']);
    }
    public function clone_job(Request $request){
        $job_post = Jobs::find($request->item_id);
        Jobs::create([
            'title' => $job_post->title,
            'position' => $job_post->position,
            'company_name' => $job_post->company_name,
            'category_id' => $job_post->category_id,
            'vacancy' => $job_post->vacancy,
            'job_responsibility' => $job_post->job_responsibility,
            'employment_status' => $job_post->employment_status,
            'education_requirement' => $job_post->education_requirement,
            'job_context' => $job_post->job_context,
            'experience_requirement' => $job_post->experience_requirement,
            'additional_requirement' => $job_post->additional_requirement,
            'job_location' => $job_post->job_location,
            'salary' => $job_post->salary,
            'lang' => $job_post->lang,
            'other_benefits' => $job_post->other_benefits,
            'email' => $job_post->email,
            'status' => 'draft',
            'deadline' => $job_post->deadline,
            'meta_tags' => $job_post->meta_tags,
            'meta_description' => $job_post->meta_description,
            'application_fee' => $job_post->application_fee,
            'application_fee_status' => $job_post->application_fee_status,
            'slug' => $job_post->title.random_int(999,9999),
        ]);
        return redirect()->back()->with(['msg' => __('Job Post Clone Success...'),'type' => 'success']);
    }
    public function delete_job(Request $request,$id){
        Jobs::find($id)->delete();

        return redirect()->back()->with(['msg' => __('Job Post Deleted Success'),'type' => 'danger']);
    }
    public function page_settings(){
        $all_languages = Language::all();
        return view('backend.jobs.job-page-settings')->with(['all_languages' => $all_languages]);
    }

    public function update_page_settings(Request $request){
        $this->validate($request,[
           'site_job_post_items' => 'required|string|max:191'
        ]);
        $all_languages = Language::all();
        foreach ($all_languages as $lang){
            $this->validate($request,[
               'site_jobs_category_'.$lang->slug.'_title'  => 'nullable|string'
            ]);
            $site_jobs_category_title = 'site_jobs_category_'.$lang->slug.'_title';
            update_static_option('site_jobs_category_'.$lang->slug.'_title',$request->$site_jobs_category_title);
        }
        update_static_option('site_job_post_items',$request->site_job_post_items);
        return redirect()->back()->with(['msg' => __('Job Page Settings Success...'),'type' => 'success']);
    }

    public function single_page_settings(){
        $all_languages = Language::all();
        return view('backend.jobs.job-single-page-settings')->with(['all_languages' => $all_languages]);
    }

    public function update_single_page_settings(Request $request){
        $this->validate($request,[
            'job_single_page_apply_form' => 'nullable|string|max:191',
            'job_single_page_applicant_mail' => 'required|string|max:191',
        ]);

        $all_languages = Language::all();
        foreach ($all_languages as $lang){
            $this->validate($request,[
                'job_single_page_'.$lang->slug.'_job_context_label'  => 'nullable|string',
                'job_single_page_'.$lang->slug.'_job_responsibility_label'  => 'nullable|string',
                'job_single_page_'.$lang->slug.'_education_requirement_label'  => 'nullable|string',
                'job_single_page_'.$lang->slug.'_experience_requirement_label'  => 'nullable|string',
                'job_single_page_'.$lang->slug.'_additional_requirement_label'  => 'nullable|string',
                'job_single_page_'.$lang->slug.'_others_benefits_label'  => 'nullable|string',
                'job_single_page_'.$lang->slug.'_apply_button_text'  => 'nullable|string',
                'job_single_page_'.$lang->slug.'_job_info_text'  => 'nullable|string',
                'job_single_page_'.$lang->slug.'_company_name_text'  => 'nullable|string',
                'job_single_page_'.$lang->slug.'_job_category_text'  => 'nullable|string',
                'job_single_page_'.$lang->slug.'_job_position_text'  => 'nullable|string',
                'job_single_page_'.$lang->slug.'_job_type_text'  => 'nullable|string',
                'job_single_page_'.$lang->slug.'_salary_text'  => 'nullable|string',
                'job_single_page_'.$lang->slug.'_job_location_text'  => 'nullable|string',
                'job_single_page_'.$lang->slug.'_job_deadline_text'  => 'nullable|string',
                'job_single_page_'.$lang->slug.'_job_application_fee_text'  => 'nullable|string',
            ]);

            $all_fileds = [
                'job_single_page_'.$lang->slug.'_job_context_label',
                'job_single_page_'.$lang->slug.'_job_responsibility_label',
                'job_single_page_'.$lang->slug.'_education_requirement_label',
                'job_single_page_'.$lang->slug.'_experience_requirement_label',
                'job_single_page_'.$lang->slug.'_additional_requirement_label',
                'job_single_page_'.$lang->slug.'_others_benefits_label',
                'job_single_page_'.$lang->slug.'_apply_button_text',
                'job_single_page_'.$lang->slug.'_job_info_text',
                'job_single_page_'.$lang->slug.'_company_name_text',
                'job_single_page_'.$lang->slug.'_job_category_text',
                'job_single_page_'.$lang->slug.'_job_position_text',
                'job_single_page_'.$lang->slug.'_job_type_text',
                'job_single_page_'.$lang->slug.'_salary_text',
                'job_single_page_'.$lang->slug.'_job_location_text',
                'job_single_page_'.$lang->slug.'_job_deadline_text',
                'job_single_page_'.$lang->slug.'_job_application_fee_text',
            ];
            foreach ($all_fileds as $field){
                update_static_option($field,$request->$field);
            }
        }

        update_static_option('job_single_page_apply_form',$request->job_single_page_apply_form);
        update_static_option('job_single_page_applicant_mail',$request->job_single_page_applicant_mail);

        return redirect()->back()->with(['msg' => __('Job Page Settings Success...'),'type' => 'success']);
    }

    public function all_jobs_applicant(){
        $all_applicant = JobApplicant::all();
        return view('backend.jobs.all-applicant')->with(['all_applicant' => $all_applicant]);
    }

    public function delete_job_applicant(Request $request,$id){
        $job_details = JobApplicant::find($id);
        $all_attachment = unserialize($job_details->attachment);
         if(is_array($all_attachment) || is_object($all_attachment)){
            foreach($all_attachment as $name => $path){
                if(file_exists($path)){
                    @unlink($path);
                }
            }
        }
        JobApplicant::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Job Application Delete Success...'),'type' => 'danger']);
    }

    public function bulk_action(Request $request){
        Jobs::whereIn('id',$request->ids)->delete();

        return response()->json(['status' => 'ok']);
    }
    public function job_applicant_bulk_delete(Request $request){
        JobApplicant::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

    public function job_applicant_report(Request  $request){
        $order_data = '';
        $jobs = Jobs::where(['status' => 'publish','lang' => get_default_language()])->get();
        $query = JobApplicant::query();
        if (!empty($request->start_date)){
            $query->whereDate('created_at','>=',$request->start_date);
        }
        if (!empty($request->end_date)){
            $query->whereDate('created_at','<=',$request->end_date);
        }
        if (!empty($request->job_id)){
            $query->where(['jobs_id' => $request->job_id ]);
        }
        $error_msg = __('select start & end date to generate applicant report');
        if (!empty($request->start_date) && !empty($request->end_date)){
            $query->orderBy('id','DESC');
            $order_data =  $query->paginate($request->items);
            $error_msg = '';
        }

        return view('backend.jobs.applicant-report')->with([
            'order_data' => $order_data,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'items' => $request->items,
            'job_id' => $request->job_id,
            'jobs' => $jobs,
            'error_msg' => $error_msg
        ]);
    }

    public function success_page_settings(){
        $all_languages = Language::all();
        return view('backend.jobs.job-success-page')->with(['all_languages' => $all_languages]);
    }
    public function cancel_page_settings(){
        $all_languages = Language::all();
        return view('backend.jobs.job-cancel-page')->with(['all_languages' => $all_languages]);
    }
    public function update_cancel_page_settings(Request $request){
        $all_languages = Language::all();
        foreach ($all_languages as $lang){
            $this->validate($request,[
                'job_cancel_page_'.$lang->slug.'_title'  => 'nullable|string',
                'job_cancel_page_'.$lang->slug.'_description'  => 'nullable|string',
            ]);

            $all_fileds = [
                'job_cancel_page_'.$lang->slug.'_title',
                'job_cancel_page_'.$lang->slug.'_description',
            ];
            foreach ($all_fileds as $field){
                update_static_option($field,$request->$field);
            }
        }
        return redirect()->back()->with(['msg' => __('Settings Update'),'type' => 'success']);
    }
    public function update_success_page_settings(Request $request){
        $all_languages = Language::all();
        foreach ($all_languages as $lang){
            $this->validate($request,[
                'job_success_page_'.$lang->slug.'_title'  => 'nullable|string',
                'job_success_page_'.$lang->slug.'_description'  => 'nullable|string',
            ]);

            $all_fileds = [
                'job_success_page_'.$lang->slug.'_title',
                'job_success_page_'.$lang->slug.'_description',
            ];
            foreach ($all_fileds as $field){
                update_static_option($field,$request->$field);
            }
        }
        return redirect()->back()->with(['msg' => __('Settings Update'),'type' => 'success']);
    }
    public function job_applicant_mail(Request $request){
        $this->validate($request,[
           'applicant_id' => 'required',
           'name' => 'nullable',
           'email' => 'nullable',
           'subject' => 'required',
           'message' => 'required',
        ]);

        $applicant_details = JobApplicant::find($request->applicant_id);

        try {
            Mail::to($applicant_details->email)->send(new BasicMail([
                'subject' => $request->subject,
                'message' => $request->message
            ]));
        }catch (\Exception $e){
            return redirect()->back()->with(NexelitHelpers::item_delete($e->getMessage()));
        }

        return redirect()->back()->with(['msg' => __('Mail Send Success'),'type' => 'success']);
    }

    public function slug_check(Request $request){
        $this->validate($request,[
            'slug' => 'required|string',
            'type' => 'required|string',
            'lang' => 'required|string',
        ]);
        $user_given_slug = $request->slug;
        $query = Jobs::where(['slug' => $user_given_slug]);
        if (!empty($request->lang)){
            $query->where('lang' , $request->lang);
        }
        $slug_count = $query->count();

        if ($request->type === 'new' && $slug_count > 0){
            return $user_given_slug.'-'.$slug_count;
        }elseif ($request->type === 'update' && $slug_count > 1){
            return $user_given_slug.'-'.$slug_count;
        }
        return $user_given_slug;
    }
}
