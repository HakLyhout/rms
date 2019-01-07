<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class UsertypeController extends Controller
{
    public function index()
    {
        $this->AdminAuthCheck();
    	return view('admin.usertype');
    }
    public function all_usertypes()
    {
        $this->AdminAuthCheck();
    	$all_usertype_info = DB::table('main_type')->get();
    	$manage_usertype = view('admin.usertype')
    	->with('all_usertype_info',$all_usertype_info);

    	return view('admin_layout')->with('admin.usertype',$manage_usertype);
    	// return view('admin.all_categories');
    }
    public function save_usertypes(Request $request)
    {
    	$data = array();
    	$data['main_type_id'] = $request->id;
    	$data['main_type_name'] = $request->main_type_name;
    	// $data['publication_status'] = $request->publication_status;

    	DB::table('main_type')->insert($data);
    	Session::put('message','<p class="alert alert-success">User Type added Successfully !</p>');
    	return Redirect::to('/usertypes');

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
    
    public function edit_usertypes($main_type_id)
    {
    	$usertype_info = DB::table('main_type')
    		->where('main_type_id',$main_type_id)
    		->first();
    	$usertype_info = view('admin.edit_usertype')
    		->with('usertype_info',$usertype_info);
    	return view('admin_layout')
    		->with('admin.edit_usertype',$usertype_info);
    	//return view('admin.edit_categories');
    }
    public function update_usertypes(Request $request,$main_type_id)
    {
    	$data = array();
    	$data['main_type_name'] = $request->main_type_name;

    	DB::table('main_type')
    		->where('main_type_id',$main_type_id)
    		->update($data);

    	Session::put('message','<p class="alert alert-success">This User Type is updated</p>');
    	return Redirect::to('/usertypes');
    }
    public function delete_usertypes($main_type_id)
    {
    	DB::table('main_type')
    		->where('main_type_id',$main_type_id)
    		->delete();
    	Session::get('message','<p class="alert alert-success">User Type Deleted Successfully</p>');
    	return Redirect::to('/usertypes');
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
