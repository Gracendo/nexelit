<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Donor;
use App\Language;
use App\Testimonial;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class TestimonialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $all_language = Language::all();
        $all_testimonial = Testimonial::all()->groupBy('lang');
        return view('backend.pages.testimonial')->with([
            'all_testimonial' => $all_testimonial,
            'all_languages' => $all_language,
        ]);
    }
    public function store(Request $request){
        $this->validate($request,[
           'name' => 'required|string|max:191',
           'lang' => 'required|string|max:191',
           'description' => 'required',
           'designation' => 'string|max:191',
           'status' => 'string|max:191',
           'image' => 'nullable|string|max:191',
        ]);
        Testimonial::create([
            'name' => $request->name,
            'description' => $request->description,
            'lang' => $request->lang,
            'status' => $request->status,
            'designation' => $request->designation,
            'image' => $request->image
        ]);
        return redirect()->back()->with(['msg' => __('New Testimonial Added Success'),'type' => 'success']);
    }

    public function update(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'description' => 'required',
            'designation' => 'string|max:191',
            'lang' => 'string|max:191',
            'status' => 'string|max:191',
            'image' => 'nullable|string|max:191',
        ]);
         Testimonial::find($request->id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'lang' => $request->lang,
            'status' => $request->status,
            'designation' => $request->designation,
            'image' => $request->image
        ]);

        return redirect()->back()->with(['msg' => __('Testimonial Update Success'),'type' => 'success']);
    }
    public function clone(Request $request){
        $testimonial = Testimonial::find($request->item_id);

        Testimonial::create([
            'name' => $testimonial->name,
            'description' => $testimonial->description,
            'lang' => $testimonial->lang,
            'status' => 'draft',
            'designation' => $testimonial->designation,
            'image' => $testimonial->image
        ]);

        return redirect()->back()->with(['msg' => __('Testimonial Clone Success'),'type' => 'success']);
    }

    public function delete(Request $request,$id){

        $testimonial = Testimonial::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Testimonial Delete Success'),'type' => 'danger']);
    }

    public function bulk_action(Request $request){
        Testimonial::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
