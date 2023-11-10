<?php

namespace App\Http\Controllers\Frontend;

use App\Course;
use App\CourseCoupon;
use App\CourseCurriculm;
use App\CourseEnroll;
use App\CourseInstructor;
use App\CourseLang;
use App\CourseLession;
use App\CourseLessionLang;
use App\CourseReview;
use App\CoursesCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    const BASE_PATH = 'frontend.pages.courses.';

    public function single($slug,$id){
        $course = Course::where('id',$id)->with('lang_front')->with('category')->with('curriculum')->first();
        if (empty($course)){abort(404);}
        $is_purchased = false;
        if (auth()->guard('web')->check()){
            //check is it preview
            $enroll_details = CourseEnroll::where(['course_id' => $id,'user_id' => auth()->guard('web')->user()->id])->first();
            $is_purchased =  $enroll_details ? $enroll_details->payment_status === 'complete' : $is_purchased;
        }
        $enroll_count = CourseEnroll::where(['course_id' => $id,'payment_status' => 'complete'])->count();
        Course::where('id',$id)->update([
            'enrolled_student' => $enroll_count
        ]);

        $course = Course::where('id',$id)->with('lang_front')->with('category')->with('curriculum')->first();
        

        $curriculumn_ids = unserialize($course->curriculum_id,['class' => false]);
        $all_curriculumns = CourseCurriculm::whereIn('id',$curriculumn_ids)->get();
        $all_curriculumn_with_lesson = [];

        foreach ($all_curriculumns as $curriculumn){
            $all_lang = $curriculumn->lang_front;
            $all_lesson = CourseLession::where(['curriculum_id' => $curriculumn->id, 'course_id' => $id])->get();
            $all_curriculumn_with_lesson[$curriculumn->id]['curriculum'] = [
                'title' => $all_lang->title,
                'description' => $all_lang->description,
                'count' => $all_lesson->count()
            ];

            foreach ($all_lesson as $lesson){
                $lang_front = $lesson->lang_front;
                $all_curriculumn_with_lesson[$curriculumn->id]['lessons'][$lesson->id] = [
                    'curriculum_id' => $lesson->curriculum_id,
                    'lession_id' => $lang_front->lession_id,
                    'duration' => $lesson->duration,
                    'duration_type' => $lesson->duration_type,
                    'preview' => $lesson->preview,
                    'title' => $lang_front->title
                ];
            }
        }


        return view(self::BASE_PATH.'single')->with([
            'course' => $course,
            'is_purchased' => $is_purchased,
            'all_curriculumn_with_lesson' => $all_curriculumn_with_lesson
        ]);
    }

    public function lesson_start($course_id){
        $allowed_to_access_content = false;
        if (auth()->guard('web')->check()){
            $enroll_details = CourseEnroll::where(['course_id' => $course_id,'user_id' => auth()->guard('web')->user()->id])->first();
            $allowed_to_access_content =  $enroll_details ? $enroll_details->payment_status === 'complete' : $allowed_to_access_content;
        }
        $course = Course::findOrFail($course_id);
        $lesson = (object) [
          'curriculum_id' => null,
          'id' => null,
          'video_embed_code' => null,
        ];
        return view(self::BASE_PATH.'course-lesson')->with(['preview_lesson' => $lesson,'course' =>$course,'allowed_to_access_content' => $allowed_to_access_content ,'enroll_details' => $enroll_details]);
    }

    public function lesson_preview($course_id, $lesson_id){

        $lesson = CourseLession::findOrFail($lesson_id);
        $allowed_to_access_content = ($lesson->preview === 'yes') && auth()->guard('admin')->check();

        if (auth()->guard('web')->check()){
            $enroll_details = CourseEnroll::where(['course_id' => $course_id,'user_id' => auth('web')->id(),'payment_status' => 'complete'])->first();
            $allowed_to_access_content =  !is_null($enroll_details) ? $enroll_details->payment_status === 'complete' : $allowed_to_access_content;
        }
        $course = Course::findOrFail($lesson->course_id);

        //check is logged in and user purchased it, if user nor purchased or it's not a preview redirect them to enroll page to purchase it
        return view(self::BASE_PATH.'course-lesson')->with(['preview_lesson' => $lesson,'course' =>$course,'allowed_to_access_content' => $allowed_to_access_content]);
    }

    public function instructor($slug,$id){
        $instructor = CourseInstructor::findOrFail($id);
        $courses = Course::where(['status' => 'publish' , 'instructor_id' => $instructor->id])->paginate(6);
        $reviews = CourseReview::whereIn('course_id',$courses->pluck('id'))->paginate(6);
        return view(self::BASE_PATH.'course-instructor')->with(['courses' => $courses,'instructor' => $instructor,'reviews' => $reviews]);
    }

    public function category($slug,$id){
        $category = CoursesCategory::findOrFail($id);
        $all_courses = Course::where(['status' => 'publish','categories_id'=>$category->id])->paginate(9);
        return view(self::BASE_PATH.'courses-category')->with(['all_courses' => $all_courses,'category' => $category]);
    }

    public function page(Request $request){

        $sort = $request->sort ?? '';
        $cat_id = $request->cat ?? '';
        $search_term = $request->s ?? '';
        $course_query = Course::query();

        $sort_by = 'id';
        $sorting = 'desc';


        if (!empty($search_term)){
            $course_lang_ids = CourseLang::where('title','LIKE','%'.$search_term.'%')->pluck('course_id');
            $course_query->whereIn('id',$course_lang_ids);
        }
        if (!empty($cat_id)){
            $course_query->where('categories_id' ,$cat_id);
        }
        if (!empty($sort)){
            switch ($sort){
                case('oldest'):
                    $sort_by = 'id';
                    $sorting = 'asc';
                    break;
                case('top_rated'):
                    //have to implement top rated course
                    $all_rated_appointment = CourseReview::orderBy('ratings','desc')->get('course_id')->toArray();
                    $course_query->whereIn('id',array_unique($all_rated_appointment));
                    $sort_by = 'id';
                    $sorting = 'asc';
                    break;
                case('low_price'):
                    $sort_by = 'price';
                    $sorting = 'asc';
                    break;
                case('high_price'):
                    $sort_by = 'price';
                    $sorting = 'desc';
                    break;
                default:
                    $sort_by = 'id';
                    $sorting = 'desc';
                    break;
            }
        }
        $course_query->where(['status' => 'publish']);
        $course_query->orderBy($sort_by,$sorting);
        $all_courses = $course_query->paginate(get_static_option('course_page_items'));

        $category_list = CoursesCategory::where(['status' => 'publish'])->with('lang_front')->get();

        return view(self::BASE_PATH.'courses')->with([
            'all_courses' => $all_courses,
            'category_list' => $category_list,
            'cat_id' => $cat_id,
            'search_term' => $search_term,
            'sort'=>$sort,
        ]);
    }

    public function enroll($course_id)
    {
        $course = Course::findOrFail($course_id);
       //return view with a form for enroll
        return view(self::BASE_PATH .'enroll')->with(['course' => $course]);
    }

    public function apply_coupon(Request $request){
        $course = Course::findOrfail($request->course_id);
        $return_val = ['msg' => __('enter valid coupon'),'status' => 'danger'];
        $coupon_details = CourseCoupon::where('code', $request->coupon)->first();
        if ($coupon_details){
            if ($coupon_details->discount_type === 'percentage') {
                $discount_bal = ($course->price / 100) * (int) $coupon_details->discount;
                $discounted_amount = $course->price - $discount_bal;
            } elseif ($coupon_details->discount_type === 'amount') {
                $discounted_amount = $course->price  - (int) $coupon_details->discount;
            }
            $return_val['msg'] = __('coupon applied successfully');
            $return_val['amount'] = amount_with_currency_symbol($discounted_amount);
            $return_val['status'] = 'success';
        }

        return $return_val;
    }

    public function review(Request $request){
        $this->validate($request,[
            'course_id' => 'required|numeric',
            'ratings' => 'required|numeric',
            'message' => 'required|string'
        ],[
            'ratings.required' => __('rating required'),
            'message.required' => __('message required'),
        ]);

        $user_id = auth()->guard('web')->user()->id;

        $is_purchased = CourseEnroll::where(['course_id' => $request->course_id,'user_id' => $user_id])->first();
        $old_review = CourseReview::where(['course_id' => $request->course_id,'user_id' => $user_id])->first();
        $data['type'] = 'danger';
        $data['msg'] = __('you have not used this service, you cannot leave feedback');

        if (!empty($is_purchased) && empty($old_review)){
            CourseReview::create([
                'user_id' => $user_id ?? null,
                'course_id' => $request->course_id,
                'message' => $request->message,
                'ratings' => $request->ratings
            ]);
            $data['type'] = 'success';
            $data['msg'] = __('thanks for your feedback');
        }
        if (!empty($old_review)){
            $data['msg'] = __('you have already given your feedback');
        }
        return response()->json($data);
    }

    public function payment_success($id){
        $enroll_details = CourseEnroll::findOrFail(substr($id,6,-6));
        return view(self::BASE_PATH.'payment-success')->with(['enroll_details' => $enroll_details]);
    }
    public function payment_cancel($id){

    }
}
