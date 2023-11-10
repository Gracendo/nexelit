<?php

namespace App\Http\Controllers;

use App\Admin;
use App\AdminRole;
use App\Blog;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRoleManageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']);

    }
    public function new_user(){
        $all_admin_role = AdminRole::all();
        return view('backend.user-role-manage.add-new-user')->with(['all_admin_role' => $all_admin_role]);
    }
    public function new_user_add(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'username' => 'required|string|max:191|unique:admins',
            'email' => 'required|email|max:191',
            'role' => 'required|string|max:191',
            'image' => 'nullable|string|max:191',
            'password' => 'required|min:8|confirmed'
        ]);

       Admin::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'image' => $request->image,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with(['msg' => __('New User Added Success'),'type' =>'success' ]);
    }

    public function all_user(){

        $all_user = Admin::all()->except(Auth::id());
        $all_admin_role = AdminRole::all();
        return view('backend.user-role-manage.all-user')->with(['all_user' => $all_user,'all_admin_role' => $all_admin_role]);
    }
    public function user_update(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'role' => 'required|string|max:191',
            'image' => 'nullable|string|max:191',
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'image' => $request->image
        ];

        if (!empty($request->password) && !empty($request->password_confirmation)){
            $data['password'] = Hash::make($request->password);
        }
        Admin::find($request->user_id)->update($data);


        return redirect()->back()->with(['msg' => __('User Details Updated'),'type' =>'success' ]);
    }
    public function new_user_delete(Request $request,$id){
        $blog_post = Blog::where('user_id',$id)->first();
        if (!empty($blog_post)){
            return redirect()->back()->with(['msg' => __('You can not delete this user, because this user already acclimate with a blog post'),'type' =>'danger' ]);
        }
        $admin = Admin::find($id)->delete();
        return redirect()->back()->with(['msg' => __('User Deleted'),'type' =>'danger' ]);
    }
    public function user_password_change(Request $request){
        $this->validate($request, [
            'password' => 'required|string|min:8|confirmed'
        ]);
        $user = Admin::findOrFail($request->ch_user_id);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with(['msg'=> __('Password Change Success..'),'type'=> 'success']);

    }

    public function all_user_role(){
        $all_role = AdminRole::all();
        return view('backend.user-role-manage.admin-role')->with(['all_role' => $all_role]);
    }

    public function add_new_user_role(Request $request){
        $this->validate($request,[
           'name' => 'required|string:max:191',
           'permission' => 'required',
        ]);

        AdminRole::create([
            'name' => $request->name,
            'permission' => json_encode($request->permission)
        ]);

        return redirect()->back()->with(['msg' => __('New Admin Role Added...') , 'type' => 'success']);
    }

    public function udpate_user_role(Request $request){

        $this->validate($request,[
            'name' => 'required|string:max:191',
            'permission' => 'required',
        ]);

        AdminRole::where('id',$request->admin_role_id)->update([
            'name' => $request->name,
            'permission' => json_encode($request->permission)
        ]);
        return redirect()->back()->with(['msg' => __('Admin Role Updated...') , 'type' => 'success']);
    }
    public function delete_user_role(Request $request,$id){
        AdminRole::find($request->id)->delete();
        return redirect()->back()->with(['msg' => __('Admin Role Deleted...') , 'type' => 'danger']);
    }
}
