<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class RoleController extends Controller
{
   	 public function index()
    {
        $this->AdminAuthCheck();
    	return view('admin.role');
    }
    public function all_role()
    {
        $this->AdminAuthCheck();
    	$all_role_info = DB::table('user_role')->get();
    	$manage_role = view('admin.role')
    	->with('all_role_info',$all_role_info);

    	return view('admin_layout')->with('admin.role',$manage_role);
    	// return view('admin.all_categories');
    }
    public function save_role(Request $request)
    {
    	$data = array();
    	$data['role_id'] = $request->role_id;
    	$data['name_role'] =  $request->role_name;
    	//$data['publication_status'] = $request->publication_status;

    	DB::table('user_role')->insert($data);
    	Session::put('message','Role added Successfully !');
    	return Redirect::to('/role');

    }
    // public function unactive_role($role_id)
    // {
    // 	DB::table('user_role')
    // 	->where('role_id',$role_id)
    // 	->update(['publication_status'=>0]);
    // 	Session::put('message','This Brand is Unactive !!');
    // 	return Redirect::to('/all-brand');
    // }

    // public function active_brand($manufacture_id)
    // {
    // 	DB::table('tbl_manufacture')
    // 	->where('manufacture_id',$manufacture_id)
    // 	->update(['publication_status'=>1]);
    // 	Session::put('message','This Brand is active !!');
    // 	return Redirect::to('/all-brand');
    // }
    
    public function edit_role($role_id)
    {
    	$role_info = DB::table('user_role')
    		->where('role_id',$role_id)
    		->first();
    	$role_info = view('admin.edit_role')
    		->with('role_info',$role_info);
    	return view('admin_layout')
    		->with('admin.edit_role',$role_info);
    	//return view('admin.edit_categories');
    }
    public function update_role(Request $request,$role_id)
    {
    	$data = array();
    	$data['name_role'] = $request->role_name;
    	DB::table('user_role')
    		->where('role_id',$role_id)
    		->update($data);

    	Session::put('message','This Role is updated');
    	return Redirect::to('/role');
    }
    public function delete_role($role_id)
    {
    	DB::table('user_role')
    		->where('role_id',$role_id)
    		->delete();
    	Session::get('message','Role Deleted Successfully');
    	return Redirect::to('/role');
    }
    public function AdminAuthCheck()
    {
        $admin_id = Session::get('user_id');
        if($admin_id)
        {
            return;
        }else
        {
            return Redirect::to('/')->send();
        }
    }
}
