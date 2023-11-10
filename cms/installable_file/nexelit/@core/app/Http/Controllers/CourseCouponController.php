<?php

namespace App\Http\Controllers;

use App\CourseCoupon;
use App\Helpers\NexelitHelpers;
use App\Language;
use Illuminate\Http\Request;

class CourseCouponController extends Controller
{
    const BASE_PATH = 'backend.courses.';
    private $all_languages;

    public function __construct()
    {
        if (is_null($this->all_languages)){
            $this->all_languages = Language::all();
        }
    }

    public function all(){
        $all_coupon = CourseCoupon::all();
        return view(self::BASE_PATH.'course-coupon')->with(['all_languages' => $this->all_languages,'all_coupon' => $all_coupon]);
    }

    public function new(Request $request){
        $this->validate($request,[
            'code' => 'required|string|max:191|unique:course_coupons',
            'discount' => 'required|string|max:191',
            'discount_type' => 'required|string|max:191',
            'expire_date' => 'required|string|max:191',
            'status' => 'required|string|max:191',
        ]);

        CourseCoupon::create([
            'code' => $request->code,
            'discount' => $request->discount,
            'discount_type' => $request->discount_type,
            'expire_date' => $request->expire_date,
            'status' => $request->status,
        ]);

        return back()->with(NexelitHelpers::item_new());
    }

    public function update(Request $request){
        $this->validate($request,[
            'code' => 'required|string|max:191|unique:course_coupons,code,'.$request->id,
            'discount' => 'required|string|max:191',
            'discount_type' => 'required|string|max:191',
            'expire_date' => 'required|string|max:191',
            'status' => 'required|string|max:191',
        ]);

        CourseCoupon::findOrFail($request->id)->update([
            'code' => $request->code,
            'discount' => $request->discount,
            'discount_type' => $request->discount_type,
            'expire_date' => $request->expire_date,
            'status' => $request->status,
        ]);

        return back()->with(NexelitHelpers::item_update());
    }

    public function delete($id){
        CourseCoupon::findOrFail($id)->delete();
        return back()->with(NexelitHelpers::item_delete());
    }

    public function bulk_action(Request $request){
        CourseCoupon::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
