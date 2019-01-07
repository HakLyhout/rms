<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class ReportController extends Controller
{
    public function index()
    {
        $this->AdminAuthCheck();
    	return view('admin.report');
    }
    public function all_reports()
    {
        $this->AdminAuthCheck();
    	$all_report_info = DB::table('report_type')->get();
    	$manage_report = view('admin.report')
    	->with('all_report_info',$all_report_info);

    	return view('admin_layout')->with('admin.report',$manage_report);
    	// return view('admin.all_categories');
    }
    public function save_reports(Request $request)
    {
    	$data = array();
    	$data['report_type_id'] = $request->id;
    	$data['report_type_name'] = $request->report_type_name;
    	// $data['publication_status'] = $request->publication_status;

    	DB::table('report_type')->insert($data);
    	Session::put('message','<p class="alert alert-success">Report Type added Successfully !</p>');
    	return Redirect::to('/reports');

    }
    // public function unactive_categories($id)
    // {
    // 	DB::table('tbl_category')
    // 	->where('id',$id)
    // 	->update(['publication_status'=>0]);
    // 	Session::put('message','This Category is Unactive !!');
    // 	return Redirect::to('/all-categories');
    // }

    // public function active_categories($id)
    // {
    // 	DB::table('tbl_category')
    // 	->where('id',$id)
    // 	->update(['publication_status'=>1]);
    // 	Session::put('message','This Category is active !!');
    // 	return Redirect::to('/all-categories');
    // }
    
    public function edit_reports($report_type_id)
    {
    	$report_info = DB::table('report_type')
    		->where('report_type_id',$report_type_id)
    		->first();
    	$report_info = view('admin.edit_report')
    		->with('report_info',$report_info);
    	return view('admin_layout')
    		->with('admin.edit_report',$report_info);
    	//return view('admin.edit_categories');
    }
    public function update_reports(Request $request,$report_type_id)
    {
    	$data = array();
    	$data['report_type_name'] = $request->report_type_name;

    	DB::table('report_type')
    		->where('report_type_id',$report_type_id)
    		->update($data);

    	Session::put('message','<p class="alert alert-success">This Report Type is updated</p>');
    	return Redirect::to('/reports');
    }
    public function delete_reports($report_type_id)
    {
    	DB::table('report_type')
    		->where('report_type_id',$report_type_id)
    		->delete();
    	Session::get('message','<p class="alert alert-success">Report Type Deleted Successfully</p>');
    	return Redirect::to('/reports');
    }
    public function AdminAuthCheck()
    {
        $admin_id = Session::get('user_id');
        if($admin_id)
        {
            return;
        }else
        {
            return Redirect::to('/admin')->send();
        }
    }
}
