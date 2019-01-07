<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class PaymentController extends Controller
{
    public function index()
    {
        $this->AdminAuthCheck();
    	return view('admin.payment');
    }
    public function all_payments()
    {
        $this->AdminAuthCheck();
    	$all_payment_info = DB::table('ad_status')->get();
    	$manage_payment = view('admin.payment')
    	->with('all_payment_info',$all_payment_info);

    	return view('admin_layout')->with('admin.payment',$manage_payment);
    	// return view('admin.all_categories');
    }
    public function save_payments(Request $request)
    {
    	$data = array();
    	$data['ad_status_id'] = $request->id;
    	$data['ad_status_name'] = $request->ad_status_name;
    	// $data['publication_status'] = $request->publication_status;

    	DB::table('ad_status')->insert($data);
    	Session::put('message','<p class="alert alert-success">Report Type added Successfully !</p>');
    	return Redirect::to('/payments');

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
    
    public function edit_payments($ad_status_id)
    {
    	$payment_info = DB::table('ad_status')
    		->where('ad_status_id',$ad_status_id)
    		->first();
    	$payment_info = view('admin.edit_payment')
    		->with('payment_info',$payment_info);
    	return view('admin_layout')
    		->with('admin.edit_payment',$payment_info);
    	//return view('admin.edit_categories');
    }
    public function update_payments(Request $request,$ad_status_id)
    {
    	$data = array();
    	$data['ad_status_name'] = $request->ad_status_name;

    	DB::table('ad_status')
    		->where('ad_status_id',$ad_status_id)
    		->update($data);

    	Session::put('message','<p class="alert alert-success">This Status is updated</p>');
    	return Redirect::to('/payments');
    }
    public function delete_payments($ad_status_id)
    {
    	DB::table('ad_stauts')
    		->where('ad_status_id',$ad_status_id)
    		->delete();

    	Session::get('message','<p class="alert alert-success">Payments Deleted Successfully</p>');
    	return Redirect::to('/payments');
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
