<?php

namespace App\Http\Controllers;

use App\Language;
use App\TeamMember;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class TeamMemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $all_language = Language::all();
        $all_team_member = TeamMember::all()->groupBy('lang');
        return view('backend.pages.team-member')->with(['all_team_member' => $all_team_member,'all_languages' => $all_language]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'designation' => 'required|string|max:191',
            'image' => 'nullable|string|max:191',
            'icon_one' => 'nullable|string|max:191',
            'icon_two' => 'nullable|string|max:191',
            'icon_three' => 'nullable|string|max:191',
            'icon_one_url' => 'nullable|string|max:191',
            'icon_two_url' => 'nullable|string|max:191',
            'icon_three_url' => 'nullable|string|max:191'
        ]);
        TeamMember::create($request->all());

        return redirect()->back()->with(['msg' => __('New Team Member Added...'), 'type' => 'success']);
    }

    public function update(Request $request)
    {


        $this->validate($request, [
            'name' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'designation' => 'required|string|max:191',
            'image' => 'nullable|string|max:191',
            'icon_one' => 'nullable|string|max:191',
            'icon_two' => 'nullable|string|max:191',
            'icon_three' => 'nullable|string|max:191',
            'icon_one_url' => 'nullable|string|max:191',
            'icon_two_url' => 'nullable|string|max:191',
            'icon_three_url' => 'nullable|string|max:191'
        ]);
        TeamMember::find($request->id)->update($request->all());

        return redirect()->back()->with(['msg' => __('Team Member Details Updated...'), 'type' => 'success']);
    }

    public function delete($id)
    {
       TeamMember::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Delete Success...'), 'type' => 'danger']);
    }

    public function bulk_action(Request $request){
        TeamMember::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
