<?php

namespace App\Http\Controllers;

use App\CourseCurriculmLang;
use App\CourseLession;
use App\CourseLessionLang;
use App\Helpers\NexelitHelpers;
use App\Language;
use http\Exception\UnexpectedValueException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseLessonController extends Controller
{

    const BASE_PATH = 'backend.courses.lesson.';
    private $all_languages ;

    public function __construct(){
        $this->all_languages = $this->all_languages ?? Language::all();
    }

    public function ajax_new(Request $request){
        $lession_id = CourseLession::create([
            'course_id' => $request->course_id,
            'curriculum_id' => $request->curriculum_id,
            'status' => 'publish'
        ])->id;
        foreach ($this->all_languages as $lang){
            CourseLessionLang::create([
                'lession_id' => $lession_id,
                'lang' => $lang->slug,
                'title' =>  __('lesson title')
            ]);
        }
        return response()->json($lession_id);
    }

    public function ajax_delete(Request $request){
        CourseLession::findOrFail($request->lesson_id)->delete();
        CourseLessionLang::where('id',$request->lesson_id)->delete();
        return response()->json('ok');
    }

    public function all(){
        $all_lesson = CourseLession::with('lang')->get();
        return view(self::BASE_PATH.'lesson-all')->with(['all_lesson' => $all_lesson]);
    }

    public function delete($id){
        CourseLession::findOrFail($id)->delete();
        CourseLessionLang::where('id',$id)->delete();
        return back()->with(NexelitHelpers::item_delete());
    }

    public function edit($id){
        $lesson = CourseLession::where('id',$id)->first();
        return view(self::BASE_PATH.'lesson-edit')->with(['lesson' => $lesson,'all_languages' => $this->all_languages]);
    }

    public function update(Request $request){
        $this->validate($request,[
            'title' => 'check_array:1',
            'description' => 'check_array:1',
            'video_embed_code' => 'nullable|string',
            'duration' => 'nullable|string',
            'duration_type' => 'nullable|string',
            'status' => 'required|string',
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx,txt,zip|max:30000'
        ],[
            'title.check_array' => __('enter title for all language')
        ]);

        $lesson = CourseLession::findOrFail($request->id);

        CourseLession::findOrFail($request->id)->update([
            'video_embed_code' => $request->video_embed_code,
            'status' => $request->status,
            'duration' => $request->duration,
            'duration_type' => $request->duration_type,
            'preview' => $request->preview,
        ]);

        //write code for add upload file option in lesson
        if ($request->hasFile('file')){
            $file = $request->file;
            $image_extenstion = $file->getClientOriginalExtension();
            $image_name_with_ext = $file->getClientOriginalName();

            $image_name = pathinfo($image_name_with_ext, PATHINFO_FILENAME);
            $image_name = strtolower(Str::slug($image_name));
            $image_db = $image_name . time() . '.' . $image_extenstion;
            $folder_path = 'assets/uploads/course-lesson/';
            $request->file->move($folder_path, $image_db);

            //delete old file
            if (file_exists('assets/uploads/course-lesson/'.$lesson->file)){
                @unlink('assets/uploads/course-lesson/'.$lesson->file);
            }
            CourseLession::findOrFail($request->id)->update(['file' => $image_db]);
        }


        foreach ($this->all_languages as $lang){
           CourseLessionLang::updateOrCreate(
                ['lession_id'=> $request->id,'lang' => $lang->slug]
                ,
                [ 'lession_id' => $request->id,
               'lang' => $lang->slug,
               'title' => $request->title[$lang->slug] ?? '',
               'description' => $request->description[$lang->slug] ?? ''
            ]);
        }

        return back()->with(NexelitHelpers::item_update());
    }
}
