<?php

namespace App\Http\Controllers;

use App\Counterup;
use App\Language;
use Illuminate\Http\Request;

class CounterUpController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $all_contuerup = Counterup::all()->groupBy('lang');
        $all_language = Language::all();
        return view('backend.pages.counterup')->with([
            'all_counterup' => $all_contuerup,
            'all_languages' => $all_language
        ]);
    }
    public function store(Request $request){
        $this->validate($request,[
            'icon' => 'required|string',
            'title' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'number' => 'required|string|max:191',
            'extra_text' => 'nullable|string|max:191'
        ]);

        Counterup::create($request->all());

        return redirect()->back()->with(['msg' => __('New Counterup Item Added....'),'type' => 'success']);
    }

    public function update(Request $request){
        $this->validate($request,[
            'icon' => 'required|string',
            'title' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'number' => 'required|string|max:191',
            'extra_text' => 'nullable|string|max:191'
        ]);

        Counterup::find($request->id)->update($request->all());

        return redirect()->back()->with(['msg' => __('Counterup Item Updated....'),'type' => 'success']);
    }

    public function delete(Request $request, $id){
        Counterup::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Counterup Item Deleted....'),'type' => 'danger']);
    }

    public function bulk_action(Request $request){
        $all = Counterup::find($request->ids);
        foreach($all as $item){
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }
}
