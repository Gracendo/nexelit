<?php

namespace App\Http\Controllers;

use App\Actions\SlugChecker;
use App\Course;
use App\CourseCurriculm;
use App\CourseCurriculmLang;
use App\CourseInstructor;
use App\CourseLang;
use App\CourseLession;
use App\CourseLessionLang;
use App\CoursesCategory;
use App\Helpers\NexelitHelpers;
use App\Http\Requests\SlugCheckRequest;
use App\Knowledgebase;
use App\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CoursesController extends Controller
{
    const BASE_PATH = 'backend.courses.';
    private $all_languages;

    public function __construct()
    {
        $this->all_languages = $this->all_languages ?? Language::all();
    }

    public function all()
    {
        $all_courses = Course::all();
        return view(self::BASE_PATH . 'courses-all')->with(['all_courses' => $all_courses]);
    }

    public function new()
    {
        $all_categories = CoursesCategory::with('lang')->get();
        $all_instructor = CourseInstructor::all();
        return view(self::BASE_PATH . 'course-new')->with([
            'all_categories' => $all_categories,
            'all_instructor' => $all_instructor,
            'all_languages' => $this->all_languages,
        ]);
    }

    public function store(Request $request)
    {
        //validate data
        $this->validate($request, [
            'title' => 'check_array:1',
            'price' => 'required|numeric',
            'max_student' => 'nullable|numeric',
            'duration' => 'required|string',
            'duration_type' => 'required|string',
            'instructor_id' => 'required|string',
            'external_url' => 'nullable|string',
            'featured' => 'nullable|string',
            'image' => 'nullable|string',
            'og_meta_image' => 'nullable|string',
            'status' => 'required|string',
            'curriculum_title' => 'check_array:1',
        ],[
            'title.check_array' => __('enter title for all languages'),
            'curriculum_title.check_array' => __('enter curriculum title for all languages'),
        ]);

        DB::beginTransaction();

        //insert data in course
        $course_id = Course::create([
            'image' => $request->image,
            'status' => $request->status,
            'duration' => $request->duration,
            'duration_type' => $request->duration_type,
            'max_student' => $request->max_student,
            'enrolled_student' => 0,
            'featured' => $request->featured,
            'external_url' => $request->external_url,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'enroll_required' => $request->enroll_required,
            'og_meta_image' => $request->og_meta_image,
            'instructor_id' => $request->instructor_id,
            'categories_id' => $request->categories_id
        ])->id;
        $curriculum_title = $request->curriculum_title;
        $curriculum_description = $request->curriculum_description;
        $course_lesson = $request->course_lesson;
        $currculmn_ids = [];
        foreach ($curriculum_title as $key => $cur_title) {

            //insert data in curruculmn talbe
            $curriculum_id = CourseCurriculm::create([
                'course_id' => $course_id
            ])->id;
            $currculmn_ids[] = $curriculum_id;

            foreach ($this->all_languages as $lang) {
                CourseCurriculmLang::create([
                    'curriculum_id' => $curriculum_id,
                    'lang' => $lang->slug,
                    'title' => $cur_title[$lang->slug] ?? '',
                    'description' => $curriculum_description[$key][$lang->slug] ?? ''
                ]);
            }
//
            //insert data in lession with curriculmn and course
            foreach ($course_lesson[$key] as $lesson) {

                $lesson_id = CourseLession::create([
                    'course_id' => $course_id,
                    'curriculum_id' => $curriculum_id,
                    'status' => 'publish',
                    'preview' => 'no'
                ])->id;
                foreach ($this->all_languages as $lang) {
                    CourseLessionLang::create([
                        'lession_id' => $lesson_id,
                        'lang' => $lang->slug,
                        'title' => $lesson
                    ]);
                }
            }
        }
        Course::findOrFail($course_id)->update([
            'curriculum_id' => $currculmn_ids,
        ]);
//
        foreach ($this->all_languages as $lang) {
            //course lang
          CourseLang::create([
                'course_id' => $course_id,
                'lang' => $lang->slug,
                'title' => $request->title[$lang->slug] ?? '',
                'slug' => $request->slug[$lang->slug] ? \Str::slug($request->slug[$lang->slug]) : \Str::slug($request->title[$lang->slug] ?? ''),
                'description' => $request->description[$lang->slug] ?? '',
                'meta_tag' => $request->meta_tags[$lang->slug] ?? '',
                'meta_title' => $request->meta_title[$lang->slug] ?? '',
                'meta_description' => $request->meta_description[$lang->slug] ?? '',
                'og_meta_title' => $request->og_meta_title[$lang->slug] ?? '',
            ]);

        }

        DB::commit();
        try {

        } catch (\Throwable $e) {
            DB::rollBack();
        }

        return back()->with(NexelitHelpers::item_new());
    }


    public function edit($id)
    {

        $all_categories = CoursesCategory::with('lang')->get();
        $all_instructor = CourseInstructor::all();
        $course = Course::findOrFail($id);

        $curriculumn_ids = unserialize($course->curriculum_id,['class' => false]);
        $all_curriculumns = CourseCurriculm::whereIn('id',$curriculumn_ids)->get();
        $all_curriculumn_with_lesson = [];

        foreach ($all_curriculumns as $curriculumn){
            $all_lang = $curriculumn->lang_all;
            foreach ($all_lang as $item){
                $all_curriculumn_with_lesson[$curriculumn->id]['curriculum'][$item->lang] = [
                    'title' => $item->title,
                    'description' => $item->description
                ];
            }
            $all_lesson = CourseLession::where(['curriculum_id' => $curriculumn->id, 'course_id' => $id])->get();
            foreach ($all_lesson as $lesson){
                $all_langs = $lesson->lang_all;
                foreach ($all_langs as $lang){
                    $all_curriculumn_with_lesson[$curriculumn->id]['lessons'][$lesson->id][$lang->lang] = [
                        'curriculum_id' => $lesson->curriculum_id,
                        'lession_id' => $lang->lession_id,
                        'title' => $lang->title
                    ];
                }
            }
        }

        return view(self::BASE_PATH . 'course-edit')->with([
            'all_categories' => $all_categories,
            'all_instructor' => $all_instructor,
            'all_languages' => $this->all_languages,
            'course' => $course,
            'all_curriculumn_with_lesson' => $all_curriculumn_with_lesson,
        ]);
    }


    //currilumn_ajax
    public function currilumn_ajax(Request $request)
    {
        //get course details for curricu update
        $course_details = Course::findOrFail($request->course_id);
        //add new curriculmn
        $curriculmn_id = CourseCurriculm::create([
            'course_id' => $request->course_id
        ])->id;
        $cur_ids = unserialize($course_details->curriculum_id, ['class' => false]);
        $cur_ids[] = $curriculmn_id;
        $course_details->curriculum_id = $cur_ids;
        $course_details->save();
        //add new data for curilumn lang
        $lession_id = CourseLession::create([
            'course_id' => $request->course_id,
            'curriculum_id' => $curriculmn_id,
            'status' => 'publish'
        ])->id;

        foreach ($this->all_languages as $lang) {
            CourseCurriculmLang::create([
                'curriculum_id' => $curriculmn_id,
                'lang' => $lang->slug,
                'title' => __('curriculum title'),
                'description' => '',
            ]);
            CourseLessionLang::create([
                'lession_id' => $lession_id,
                'lang' => $lang->slug,
                'title' => __('lesson title')
            ]);
        }

        //return json response with curricumn id
        return response()->json([
            'lesson_id' => $lession_id,
            'curriculum_id' => $curriculmn_id,
        ]);
    }

    public function currilumn_ajax_delete(Request $request)
    {
        $curriculmn__id = $request->curriculmn__id;
        CourseCurriculm::find($curriculmn__id)->delete();
        CourseCurriculmLang::where('curriculum_id', $curriculmn__id)->delete();
        $all_lesson = CourseLession::where('curriculum_id', $curriculmn__id)->pluck('id');
        CourseLession::where('curriculum_id', $curriculmn__id)->delete();
        CourseLessionLang::whereIn('lession_id', $all_lesson)->delete();

        $course_details = Course::findOrFail($request->course_id);
        $cur_ids = unserialize($course_details->curriculum_id, ['class' => false]);
        unset($cur_ids[$curriculmn__id]);
        $course_details->curriculum_id = $cur_ids;
        $course_details->save();

        return response()->json('ok');
    }

    public function update(Request $request)
    {
        //validate data
        $this->validate($request, [
            'title' => 'check_array:1',
            'price' => 'required|numeric',
            'max_student' => 'nullable|numeric',
            'duration' => 'required|string',
            'duration_type' => 'required|string',
            'instructor_id' => 'required|string',
            'external_url' => 'nullable|string',
            'featured' => 'nullable|string',
            'image' => 'nullable|string',
            'og_meta_image' => 'nullable|string',
            'status' => 'required|string',
            'curriculum_title' => 'check_array:1',
        ],[
            'title.check_array' => __('enter title for all languages')
        ]);

        $course_id = $request->id;
        //insert data in course
        Course::findOrFail($course_id)->update([
            'image' => $request->image,
            'status' => $request->status,
            'duration' => $request->duration,
            'duration_type' => $request->duration_type,
            'max_student' => $request->max_student,
            'featured' => $request->featured,
            'external_url' => $request->external_url,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'enroll_required' => $request->enroll_required,
            'og_meta_image' => $request->og_meta_image,
            'instructor_id' => $request->instructor_id,
            'categories_id' => $request->categories_id,
            'curriculum_id' => array_keys($request->curriculum_title)
        ]);

        $curriculum_title = $request->curriculum_title;
        $curriculum_description = $request->curriculum_description;
        $course_lesson = $request->course_lesson;
        foreach ($curriculum_title as $cur_id => $cur_title) {
            foreach ($this->all_languages as $lang) {
                $first_curr = CourseCurriculmLang::where(['curriculum_id' => $cur_id, 'lang' => $lang->slug])->first();
                if ($first_curr){
                    CourseCurriculmLang::updateOrCreate(
                        ['curriculum_id' => $cur_id, 'lang' => $lang->slug],
                        [
                        'title' => $cur_title[$lang->slug] ?? '',
                        'description' => $curriculum_description[$cur_id][$lang->slug] ?? ''
                    ]);
                }else{
                    CourseCurriculmLang::create([
                        'curriculum_id' => $cur_id,
                        'lang' => $lang->slug,
                        'title' => $cur_title[$lang->slug] ?? '',
                        'description' => $curriculum_description[$cur_id][$lang->slug] ?? ''
                    ]);
                }
            }

            //insert data in lesson with curriculum and course
            foreach ($course_lesson[$cur_id] as $les_id => $less_title) {

                if (is_array($less_title)) {
                    CourseLessionLang::where(['lession_id' => $les_id, 'lang' => get_default_language()])->update([
                        'title' => is_array($less_title) ? current($less_title) : ''
                    ]);
                } else {
                    $lsesson_id = CourseLession::create([
                        'course_id' => $course_id,
                        'curriculum_id' => $cur_id,
                        'status' => 'publish'
                    ])->id;

                    foreach ($this->all_languages as $langu) {
                        CourseLessionLang::create([
                            'lession_id' => $lsesson_id,
                            'lang' => $langu->slug,
                            'title' => $less_title
                        ]);
                    }
                }

            }
        }

        foreach ($this->all_languages as $lang) {
            //course lang
            $slug = \Str::slug($request->slug[$lang->slug] ?? '') ;
             CourseLang::updateOrCreate(
                ['course_id' => $course_id, 'lang' => $lang->slug],
                [
                'course_id' => $course_id,
                'lang' =>$lang->slug,
                'title' => $request->title[$lang->slug] ?? '',
                'slug' => $slug ?? \Str::slug($request->title[$lang->slug] ?? ''),
                'description' => $request->description[$lang->slug] ?? '',
                'meta_tag' => $request->meta_tags[$lang->slug] ?? '',
                'meta_title' => $request->meta_title[$lang->slug] ?? '',
                'meta_description' => $request->meta_description[$lang->slug] ?? '',
                'og_meta_title' => $request->og_meta_title[$lang->slug] ?? '',
            ]);
        }

        return back()->with(NexelitHelpers::item_update());
    }

    public function delete($id)
    {
        $course = Course::findOrFail($id);
        $curse_id = $course->id;
        $curriculum_ids = unserialize($course->curriculum_id, ['class' => false]);
        $all_lesson = CourseLession::whereIn('curriculum_id', $curriculum_ids)->get()->pluck('id');
        // delete course
        $course->delete();
        //delete course lang
        CourseLang::where('course_id', $curse_id)->delete();
        //delete curriculum table
        CourseCurriculm::whereIn('id', $curriculum_ids)->delete();
        //delete curriculum lang table
        CourseCurriculmLang::whereIn('curriculum_id', $curriculum_ids)->delete();
        // delete lesson table
        CourseLession::whereIn('id', $all_lesson)->delete();
        //delete lesson lang table
        CourseLessionLang::whereIn('lession_id', $all_lesson)->delete();
        return back()->with(NexelitHelpers::item_delete());
    }

    public function bulk_action(Request $request)
    {
        $courses = Course::whereIn('id', $request->ids)->get();

        foreach ($courses as $course) {
            $curse_id = $course->id;
            $curriculum_ids = unserialize($course->curriculum_id, ['class' => false]);
            $all_lesson = CourseLession::whereIn('curriculum_id', $curriculum_ids)->get()->pluck('id');
            // delete course
            $course->delete();
            //delete course lang
            CourseLang::where('course_id', $curse_id)->delete();
            //delete curriculum table
            CourseCurriculm::whereIn('id', $curriculum_ids)->delete();
            //delete curriculum lang table
            CourseCurriculmLang::whereIn('curriculum_id', $curriculum_ids)->delete();
            // delete lesson table
            CourseLession::whereIn('id', $all_lesson)->delete();
            //delete lesson lang table
            CourseLessionLang::whereIn('lession_id', $all_lesson)->delete();
        }

        return response()->json('ok');
    }

    public function clone(Request $request)
    {

        $course = Course::findOrFail($request->id);
        $curriculum_ids = unserialize($course->curriculum_id, ['class' => false]);
        $all_curriculum = CourseCurriculm::whereIn('id', $curriculum_ids)->get();

        DB::beginTransaction();

        //insert data in course
        $course_id = Course::create([
            'image' => $course->image,
            'status' => 'draft',
            'duration' => $course->duration,
            'duration_type' => $course->duration_type,
            'max_student' => $course->max_student,
            'enrolled_student' => 0,
            'featured' => $course->featured,
            'external_url' => $course->external_url,
            'price' => $course->price,
            'sale_price' => $course->sale_price,
            'enroll_required' => $course->enroll_required,
            'og_meta_image' => $course->og_meta_image,
            'instructor_id' => $course->instructor_id,
            'categories_id' => $course->categories_id
        ])->id;

        $currculmn_ids = [];
        foreach ($all_curriculum as $curr) {
            $curriculum_id = CourseCurriculm::create([
                'course_id' => $course_id
            ])->id;
            $currculmn_ids[] = $curriculum_id;
            $course_curr_lang = CourseCurriculmLang::where('curriculum_id', $curr->id)->get();

            foreach ($course_curr_lang as $cur_lang) {
                CourseCurriculmLang::create([
                    'curriculum_id' => $curriculum_id,
                    'lang' => $cur_lang->lang,
                    'title' => $cur_lang->title,
                    'description' => $cur_lang->description
                ]);
            }

            $course_lessons = CourseLession::where(['curriculum_id' => $curr->id, 'course_id' => $course_id])->get();

            foreach ($course_lessons as $cur_lesson) {
                $lesson_lang = CourseLessionLang::where('lession_id', $cur_lesson->id)->get();
                $lesson_id = CourseLession::create([
                    'course_id' => $course_id,
                    'curriculum_id' => $curriculum_id,
                    'video_embed_code' => $cur_lesson->video_embed_code,
                    'status' => $cur_lesson->status,
                    'duration' => $cur_lesson->duration,
                    'duration_type' => $cur_lesson->duration_type,
                    'preview' => $cur_lesson->preview,
                ])->id;
                foreach ($lesson_lang as $lesso_item) {
                    CourseLessionLang::create([
                        'lession_id' => $lesson_id,
                        'lang' => $lesso_item->lang,
                        'title' => $lesso_item->title,
                        'description' => $lesso_item->description,
                    ]);
                }
            }
        }

        Course::findOrFail($course_id)->update([
            'curriculum_id' => $currculmn_ids,
        ]);
        $all_course_langs = CourseLang::where('course_id', $course->id)->get();
        foreach ($all_course_langs as $curse_lang) {
            CourseLang::create([
                'course_id' => $course_id,
                'lang' => $curse_lang->lang,
                'title' => $curse_lang->title,
                'slug' => $curse_lang->slug,
                'description' => $curse_lang->description,
                'meta_tag' => $curse_lang->meta_tags,
                'meta_title' => $curse_lang->meta_title,
                'meta_description' => $curse_lang->meta_description,
                'og_meta_title' => $curse_lang->og_meta_title,
            ]);
        }
        DB::commit();
        try {

        } catch (\Throwable $e) {
            DB::rollBack();
        }

        return back()->with(NexelitHelpers::item_clone());
    }


    public function settings(){
        return view(self::BASE_PATH.'course-settings')->with(['all_languages' => $this->all_languages]);
    }

    public function settings_update(Request $request){
        $this->validate($request,[
            'course_page_items' => 'required|string',
            'course_notify_mail' => 'nullable|string',
        ]);

        foreach ($this->all_languages as $lang){
           $this->validate($request,[
               'course_single_'.$lang->slug.'_enroll_button_text' => 'nullable|string',
               'course_single_'.$lang->slug.'_reviews_tab_title' => 'nullable|string',
               'course_single_'.$lang->slug.'_instructor_tab_title' => 'nullable|string',
               'course_single_'.$lang->slug.'_curriculum_tab_title' => 'nullable|string',
               'course_single_'.$lang->slug.'_overview_tab_title' => 'nullable|string',
               'course_single_'.$lang->slug.'_client_feedback_title' => 'nullable|string',
               'course_single_'.$lang->slug.'_leave_feedback_title' => 'nullable|string',
               'course_success_'.$lang->slug.'_title' => 'nullable|string',
               'course_success_'.$lang->slug.'_description' => 'nullable|string',
               'course_cancel_'.$lang->slug.'_title' => 'nullable|string',
               'course_cancel_'.$lang->slug.'_description' => 'nullable|string',
           ]);
           $all_fields = [
               'course_single_'.$lang->slug.'_enroll_button_text',
               'course_single_'.$lang->slug.'_reviews_tab_title',
               'course_single_'.$lang->slug.'_instructor_tab_title',
               'course_single_'.$lang->slug.'_curriculum_tab_title',
               'course_single_'.$lang->slug.'_overview_tab_title',
               'course_single_'.$lang->slug.'_client_feedback_title',
               'course_single_'.$lang->slug.'_leave_feedback_title',
               'course_success_'.$lang->slug.'_title',
               'course_success_'.$lang->slug.'_description' ,
               'course_cancel_'.$lang->slug.'_title',
               'course_cancel_'.$lang->slug.'_description'
           ];
            foreach ($all_fields as $field){
                update_static_option($field,$request->$field);
            }
        }


        $fields = [
            'course_page_items',
            'course_notify_mail',
            'course_certificate_bg_image',
        ];
        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        return back()->with(NexelitHelpers::settings_update());
    }

    public function slug_check(SlugCheckRequest $request){

        $user_given_slug = $request->slug;
        $query = CourseLang::where(['slug' => $user_given_slug]);

        return SlugChecker::Check($request,$query);
    }

}
