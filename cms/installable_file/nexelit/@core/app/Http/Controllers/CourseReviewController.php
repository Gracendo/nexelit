<?php

namespace App\Http\Controllers;

use App\CourseReview;
use App\Helpers\NexelitHelpers;
use Illuminate\Http\Request;

class CourseReviewController extends Controller
{
    public function all(){
        $all_reviews = CourseReview::all();
        return view('backend.courses.course-review')->with(['all_reviews'=>$all_reviews]);
    }

    public function delete($id){
        CourseReview::findOrFail($id)->delete();
        return back()->with(NexelitHelpers::item_delete());
    }
    public function bulk_action(Request $request){
        CourseReview::whereIn('id',$request->ids)->delete();
        return back()->with(NexelitHelpers::item_delete());
    }

}
