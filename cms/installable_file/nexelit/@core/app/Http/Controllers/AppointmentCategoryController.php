<?php

namespace App\Http\Controllers;

use App\AppointmentCategory;
use App\AppointmentCategoryLang;
use App\Helpers\NexelitHelpers;
use App\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentCategoryController extends Controller
{
    private $all_languages;
    public function __construct()
    {
        $this->all_languages = Language::all();
    }

    public function category_all(){
         $all_categories = AppointmentCategory::all();
         return view('backend.appointment.appointment-category')->with(['all_category' => $all_categories,'all_languages' => $this->all_languages ]);
    }

    public function category_new(Request $request){
        $this->validate($request,[
            'status' => 'required|string',
            'title' => 'check_array:1',
        ],[
            'title.check_array' => __('enter title')
        ]);

        DB::beginTransaction();

        try {
            $cat_id = AppointmentCategory::create(['status' => $request->status])->id;
            foreach ($this->all_languages as $lang){
                $lang_slug = $lang->slug;
                AppointmentCategoryLang::create([
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

    public function category_delete(Request $request,$id){
        AppointmentCategory::findOrFail($id)->delete();
        AppointmentCategoryLang::where('cat_id',$id)->delete();
        return back()->with(NexelitHelpers::item_delete());
    }

    public function bulk_action(Request $request){
        AppointmentCategory::whereIn('id',$request->ids)->delete();
        AppointmentCategoryLang::whereIn('cat_id',$request->ids)->delete();

        return response()->json(['status' => 'ok']);
    }

    public function category_update(Request $request){
        $this->validate($request,[
            'status' => 'required|string',
            'title' => 'check_array:1',
        ],[
            'title.check_array' => __('enter title')
        ]);

          
            
        DB::beginTransaction();

        try {
              AppointmentCategory::find($request->id)->update(['status' => $request->status]);
            foreach ($this->all_languages as $lang){
                $lang_slug = $lang->slug;
                AppointmentCategoryLang::updateOrCreate(
                    ['lang' => $lang->slug,'cat_id' => $request->id],
                    [
                    'lang' => $lang->slug,
                    'title' =>  $request->title[$lang->slug] ?? '',
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
