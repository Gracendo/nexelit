<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\LanguageHelper;
use App\Helpers\NexelitHelpers;
use App\Http\Controllers\Controller;
use App\SupportDepartment;
use Illuminate\Http\Request;

class SupportDepartmentController extends Controller
{


    public function category(){
        $all_category = SupportDepartment::all()->groupBy('lang');
        $all_language = LanguageHelper::all_languages();
        return view('backend.support-ticket.support-ticket-category.category')->with([
            'all_category' => $all_category,
            'all_languages' => $all_language
        ]);
    }
    public function new_category(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:191|unique:support_departments',
            'lang' => 'required|string|max:191',
            'status' => 'required|string|max:191'
        ]);

        SupportDepartment::create($request->all());

        return redirect()->back()->with(NexelitHelpers::item_new());
    }

    public function update(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:191|unique:support_departments,id,'.$request->id,
            'lang' => 'required|string|max:191',
            'status' => 'required|string|max:191'
        ]);

        SupportDepartment::find($request->id)->update([
            'name' => $request->name,
            'status' => $request->status,
            'lang' => $request->lang,
        ]);

        return redirect()->back()->with(NexelitHelpers::item_update());
    }

    public function delete(Request $request,$id){
        SupportDepartment::find($id)->delete();
        return redirect()->back()->with(NexelitHelpers::item_delete());
    }
    public function bulk_action(Request $request){
        SupportDepartment::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
