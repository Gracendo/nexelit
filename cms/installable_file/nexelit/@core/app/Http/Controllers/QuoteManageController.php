<?php

namespace App\Http\Controllers;

use App\Helpers\NexelitHelpers;
use App\Http\Middleware\Permission\QuoteManage;
use App\Mail\QuoteReply;
use App\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Language;

class QuoteManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function all_quotes(){
        $all_quotes = Quote::all();
        return view('backend.quote-manage.quote-manage-all')->with(['all_quotes' => $all_quotes]);
    }

    public function pending_quotes(){
        $all_quotes = Quote::where('status','pending')->get();
        return view('backend.quote-manage.quote-manage-pending')->with(['all_quotes' => $all_quotes]);
    }

    public function completed_quotes(){
        $all_quotes = Quote::where('status','completed')->get();
        return view('backend.quote-manage.quote-manage-completed')->with(['all_quotes' => $all_quotes]);
    }

    public function quote_delete(Request $request,$id){
        Quote::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Quote Status Deleted Success...'),'type' => 'danger']);
    }

    public function change_status(Request $request){
        $this->validate($request,[
           'quote_status' => 'required|string|max:191',
            'quote_id' => 'required|string|max:191'
        ]);
        Quote::find($request->quote_id)->update(['status' => $request->quote_status]);

        return redirect()->back()->with(['msg' => __('Quote Status Update Success...'),'type' => 'success']);
    }

    public function send_mail(Request $request){
        $this->validate($request,[
           'email' => 'required|string|max:191',
           'name' => 'required|string|max:191',
           'subject' => 'required|string',
           'message' => 'required|string',
        ]);
        $data = [
            'name' => $request->name,
            'message' => $request->message,
            'subject' => str_replace('{site}',get_static_option('site_'.get_default_language().'_title'),$request->subject)
        ];
        try {
            Mail::to($request->email)->send(new QuoteReply($data));
        }catch (\Exception $e){
            return redirect()->back()->with(NexelitHelpers::item_delete($e->getMessage()));
        }
        return redirect()->back()->with(['msg' => __('Quote Reply Mail Send Success...'),'type' => 'success']);
    }
    public function quote_page_index(){
        $all_language = Language::all();
        return view('backend.quote-manage.quote-page-manage')->with(['all_languages' => $all_language]);
    }

    public function quote_page_udpate(Request $request){
        $this->validate($request,[
            'quote_page_form_mail' => 'nullable|string',
        ]);
        $all_language = Language::all();

        foreach ($all_language as $lang){

            $this->validate($request,[
                'quote_page_'.$lang->slug.'_form_title' => 'nullable|string',
                'quote_page_'.$lang->slug.'_form_button_text' => 'nullable|string'
            ]);

            $fields = [
                'quote_page_'.$lang->slug.'_form_title',
                'quote_page_'.$lang->slug.'_form_button_text'
            ];
            foreach ($fields as $field){
                update_static_option($field,$request->$field);
            }
        }

        update_static_option('quote_page_form_mail',$request->quote_page_form_mail);

        return redirect()->back()->with(['msg' => __('Settings Updated....'),'type' => 'success']);
    }

    public function bulk_action(Request $request){
        Quote::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
