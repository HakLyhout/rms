<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class AdminController extends Controller
{
    public function index()
    {
    	return view('admin_login');
    }

   	public function show_dashboard()
   	{
   		return view('admin/dashboard');
   	}
   	public function dashboard(Request $request)
   	{
   		$admin_email = $request->email;
   		$admin_password = md5($request->password);
   		$result = DB::table('user_account')
   				->where('email',$admin_email)
   				->where('password',$admin_password)
   				->first();
   				
   			if($result)
   			{
   				Session::put('name',$result->name);
   				Session::put('user_id',$result->user_id);
   				return Redirect::to('/dashboard');
   			}
   			else
   			{
   				Session::put('message','Email or Password Invalid');
   				return Redirect::to('/');
   			}
   	}
}

