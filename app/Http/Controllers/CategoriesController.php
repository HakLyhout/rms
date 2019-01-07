<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class CategoriesController extends Controller
{
    public function index()
    {
        $this->AdminAuthCheck();
    	return view('admin.categories');
    }
    public function all_categories()
    {
        $this->AdminAuthCheck();
    	$all_category_info = DB::table('ad_type')->get();
    	$manage_category = view('admin.categories')
    	->with('all_category_info',$all_category_info);

    	return view('admin_layout')->with('admin.categories',$manage_category);
    	// return view('admin.all_categories');
    }
    public function save_categories(Request $request)
    {
    	$data = array();
    	$data['ad_type_id'] = $request->id;
    	$data['ad_type_name'] = $request->ad_type_name;
    	// $data['publication_status'] = $request->publication_status;

    	DB::table('ad_type')->insert($data);
    	Session::put('message','<p class="alert alert-success">Categories added Successfully !</p>');
    	return Redirect::to('/categories');

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
    
    public function edit_categories($ad_type_id)
    {
    	$category_info = DB::table('ad_type')
    		->where('ad_type_id',$ad_type_id)
    		->first();
    	$category_info = view('admin.edit_categories')
    		->with('category_info',$category_info);
    	return view('admin_layout')
    		->with('admin.edit_categories',$category_info);
    	//return view('admin.edit_categories');
    }
    public function update_categories(Request $request,$ad_type_id)
    {
    	$data = array();
    	$data['ad_type_name'] = $request->ad_type_name;

    	DB::table('ad_type')
    		->where('ad_type_id',$ad_type_id)
    		->update($data);

    	Session::put('message','<p class="alert alert-success">This Category is updated</p>');
    	return Redirect::to('/categories');
    }
    public function delete_categories($id)
    {
    	DB::table('ad_type')
    		->where('ad_type_id',$ad_type_id)
    		->delete();
    	Session::get('message','<p class="alert alert-success">Categories Deleted Successfully</p>');
    	return Redirect::to('/categories');
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
