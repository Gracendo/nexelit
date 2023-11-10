<?php

namespace App\Http\Controllers;

use App\CoursesCategory;
use App\CoursesCategoryLang;
use App\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Helpers\NexelitHelpers;

class CoursesCategoryController extends Controller
{
    const BASE_PATH = 'backend.courses.';
    private $all_languages;
    public function __construct()
    {
        $this->all_languages = Language::all();
    }

    public function category_all(){
        $all_category = CoursesCategory::all();
        return view(self::BASE_PATH.'courses-category')->with(['all_category' => $all_category,'all_languages' =>  $this->all_languages]);
    }

    public function category_new(Request $request){
        $this->validate($request,[
            'status' => 'required|string',
            'icon' => 'required|string',
            'title' => 'check_array:1',
        ],[
            'title.check_array' => __('enter title')
        ]);

        DB::beginTransaction();

        try {
            $cat_id = CoursesCategory::create(['status' => $request->status,'icon' => $request->icon])->id;
            foreach ($this->all_languages as $lang){
                $lang_slug = $lang->slug;
                CoursesCategoryLang::create([
                    'lang' => $lang_slug,
                    'title' =>  $request->title[$lang_slug] ?? '',
                    'cat_id' => $cat_id
                ]);
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            throwException($e->getMessage());
        }

        return back()->with(NexelitHelpers::item_new());
    }

    public function category_delete($id){
        CoursesCategory::findOrFail($id)->delete();
        CoursesCategoryLang::where('cat_id',$id)->delete();
        return back()->with(NexelitHelpers::item_delete());
    }

    public function bulk_action(Request $request){
        CoursesCategory::whereIn('id',$request->ids)->delete();
        CoursesCategoryLang::whereIn('cat_id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

    public function category_update(Request $request){
        $this->validate($request,[
            'status' => 'required|string',
            'icon' => 'required|string',
            'title' => 'check_array:1',
        ],[
            'title.check_array' => __('enter title')
        ]);

        DB::beginTransaction();

        try {
             CoursesCategory::find($request->id)->update(['status' => $request->status,'icon' => $request->icon]);
            foreach ($this->all_languages as $lang){
                $lang_slug = $lang->slug;
               CoursesCategoryLang::updateOrCreate(
                ['cat_id' => $request->id,'lang' => $lang->slug],
                [
                    'lang' => $lang_slug,
                    'title' =>  $request->title[$lang_slug] ?? '',
                    'cat_id' => $request->id
                ]);
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            throwException($e->getMessage());
        }

        return back()->with(NexelitHelpers::item_update());
    }
}
