<?php

namespace App\Http\Controllers;

use App\CourseInstructor;
use App\CourseInstructorLang;
use App\CoursesCategoryLang;
use App\Helpers\NexelitHelpers;
use App\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseInstructorController extends Controller
{
    const BASE_PATH = 'backend.courses.instructor.';
    private $all_language;
    public function __construct(){
        $this->all_language = $this->all_language ?? Language::all();
    }
    public function all(){
        $all_instructor = CourseInstructor::all();
        return view(self::BASE_PATH.'courses-instructor')->with(['all_instructor' => $all_instructor]);
    }
    public function new(){
        return view(self::BASE_PATH.'course-instructor-new')->with(['all_languages' => $this->all_language]);
    }

    public function edit($id){
        $instructor = CourseInstructor::where('id',$id)->first();
        return view(self::BASE_PATH.'course-instructor-edit')->with(['all_languages' => $this->all_language,'instructor' => $instructor]);
    }

    public function clone(Request $request){
        $course_instructor = CourseInstructor::findOrFail($request->id);
        $course_instructor_lang = CourseInstructorLang::where('instructor_id',$request->id)->get();
        DB::beginTransaction();

        try {
            //insert normal data
            $last_id = CourseInstructor::create([
                'image' => $course_instructor->image,
                'social_icons' => $course_instructor->social_icons,
                'name' => $course_instructor->name ,
                'designation' => $course_instructor->designation,
                'social_icon_url' => $course_instructor->social_icon_url
            ])->id;

            //insert language data
            foreach ($course_instructor_lang as $ins_lang){
                CourseInstructorLang::create([
                   'description' => $ins_lang->description,
                   'instructor_id' => $last_id,
                   'lang' => $ins_lang->lang
                ]);
            }

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            report($e);
        }

        return back()->with(NexelitHelpers::item_clone());
    }

    public function store(Request $request){
        $this->validate($request,[
            'description' => 'check_array:1',
            'image' => 'nullable|string',
            'name' => 'required|string',
            'designation' => 'nullable|string',
            'social_icon_url' => 'nullable|array',
            'social_icon' => 'nullable|array',
        ]);
        DB::beginTransaction();

        try {
            //insert normal data
            $last_id = CourseInstructor::create([
                'image' => $request->image,
                'social_icons' => $request->social_icon,
                'name' => $request->name ,
                'designation' => $request->designation,
                'social_icon_url' => $request->social_icon_url
            ])->id;
            //insert language data
            foreach ($this->all_language as $lang){
                CourseInstructorLang::create([
                    'description' => $request->description[$lang->slug] ?? '',
                    'instructor_id' => $last_id,
                    'lang' => $lang->slug
                ]);
            }

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            report($e);
        }

        return back()->with(NexelitHelpers::item_new());
    }

    public function delete($id){
        CourseInstructor::findOrFail($id)->delete();
        CourseInstructorLang::where('instructor_id',$id)->delete();
        return back()->with(NexelitHelpers::item_delete());
    }

    public function bulk_action(Request $request){
        CourseInstructor::whereIn('id',$request->ids)->delete();
        CourseInstructorLang::whereIn('instructor_id',$request->ids)->delete();
        return back()->with(NexelitHelpers::item_delete());
    }

    public function update(Request $request){
        $this->validate($request,[
            'description' => 'check_array:1',
            'image' => 'nullable|string',
            'name' => 'required|string',
            'designation' => 'nullable|string',
            'social_icon_url' => 'nullable|array',
            'social_icon' => 'nullable|array',
        ]);
        DB::beginTransaction();

        try {
            //insert normal data
            CourseInstructor::findOrFail($request->id)->update([
                'image' => $request->image,
                'social_icons' => $request->social_icon,
                'name' => $request->name ,
                'designation' => $request->designation,
                'social_icon_url' => $request->social_icon_url
            ]);
            //insert language data
            foreach ($this->all_language as $lang){
               CourseInstructorLang::updateOrCreate(
                    ['lang' => $lang->slug,'instructor_id' => $request->id],
                    [
                    'description' => $request->description[$lang->slug] ?? '',
                    'instructor_id' => $request->id,
                    'lang' => $lang->slug
                ]);
            }

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            report($e);
        }

        return back()->with(NexelitHelpers::item_update());
    }


}
