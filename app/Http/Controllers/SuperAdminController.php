<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class SuperAdminController extends Controller
{
	public function index()
	{
		$this->AdminAuthCheck();
		$count_all = DB::table('report_ad')->count();
		$count_active = DB::table('report_ad')->where('status',1)->count();
		$count_unactive = DB::table('report_ad')->where('status',0)->count();
		$start_date = DB::table('report_ad')->select('start_date')->get();
		$end_date = DB::table('report_ad')->select('end_date')->get();
		$currentDate = date('Y-m-d');
		// $articles = Article::where('expiration_date', '>', $currentDate)->get();
		$live_account = DB::table('report_ad')
			->where('end_date','<',$currentDate)
            // ->where('status',1)
			->get();

		// 	DB::table('report_ad')
    	// ->where('report_id',$report_id)
    	// ->update(['status'=>0]);
		if($end_date < $currentDate)
		{
			$auto_unactive = DB::table('report_ad')
							->where('end_date','<',$currentDate)
							->update(['status'=>0]);
		}
		
		$manage_dashboard = view('admin.dashboard')
							->with('count_all',$count_all)
							->with('count_active',$count_active)
							->with('count_unactive',$count_unactive)
							->with('end_date',$end_date)
							->with('live_account',$live_account);
							// ->with('auto_unactive',$auto_unactive);
		return view('admin_layout')->with('admin.dashboard',$manage_dashboard);
	}

  	public function logout()
  	{
  		// Session::put('admin_name',null);
  		// Session::put('admin_id',null);
  		Session::flush();
  		return Redirect::to('/');
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
