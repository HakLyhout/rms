<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Cart;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
{
   public function log_in(){
   		// redirect()
   		return view('pages.log_in');
   }
   public function customer_registration(Request $request)
   {
   	$data= array();
   	$data['customer_name'] = $request->customer_name;
   	$data['customer_email'] = $request->customer_email;
   	$data['password'] = md5($request->password) ;
   	$data['mobile_number'] = $request->mobile_number;

   	$customer_id = DB::table('tbl_customer')->insertGetId($data);
   	Session::put('customer_id',$customer_id);
   	Session::put('customer_name', $request->customer_name);
   	return Redirect('/checkout');
   }
   public function checkout()
   {
   	return view('pages.checkout');
   }
   public function shipping(Request $request){
   	$data= array();
   	$data['shipping_name'] = $request->shipping_name;
   	$data['shipping_email'] = $request->shipping_email;
   	$data['shipping_address'] = $request->shipping_address;

   	$shipping_id = DB::table('tbl_shipping')->insertGetId($data);
   	Session::put('shipping_id',$shipping_id);
   	//Session::put('customer_name', $request->customer_name);
   	return Redirect('/payment');
   }
    public function payment()
   {
      return view('pages.pay');
   }
   public function customer_login(Request $request){
   	$customer_email = $request->customer_email;
   	$password = md5($request->password);
   	$result = DB::table('tbl_customer')
   				->where('customer_email',$customer_email)
   				->where('password',$password)
   				->first();

   				if($result){
   					Session::put('customer_id',$result->customer_id);
   					return Redirect::to('/checkout');
   				}else{
   					return Redirect::to('/login');
   				}
   }
   public function order_place(Request $request){
      $payment_gateway = $request->payment_gateway;

      $pdata = array();
      $pdata['payment_method']  = $payment_gateway;
      $pdata['payment_status']  = 'pending';
      $payment_id = DB::table('tbl_payment')->insertGetId($pdata);

      $odata = array();
      $odata['customer_id'] = Session::get('customer_id');
      $odata['shipping_id'] = Session::get('shipping_id');
      $odata['payment_id'] = $payment_id;
      $odata['order_total'] = Cart::total();
      $odata['order_status'] = "pending" ;
      $order_id = DB::table("tbl_order")->insertGetId($odata);

      $contents = Cart::content();
      $ordata = array();

      foreach($contents as $v_content)
      {
         $ordata['order_id'] = $order_id;
         $ordata['product_id'] = $v_content->id;
         $ordata['product_name'] = $v_content->id;
         $ordata['product_price'] = $v_content->id;
         $ordata['product_sale_quantity'] = $v_content->qty;
         
         DB::table('tbl_order_detail')->insert($ordata);
      }

      if($payment_gateway == "handcash"){
         Cart::destroy();
         return view('pages.handcash');
      }elseif($payment_gateway == "cart"){
         echo"cart";
      }elseif($payment_gateway == "bkash"){
         echo"bkash";
      }else{
         echo"not selected";
      }
   }
   public function manage_order(){
      $all_order_info = DB::table('tbl_order')
                        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
                        ->select('tbl_order.*','tbl_customer.customer_name')
                        ->get();
      $manage_order = view('admin.manage_order')
      ->with('all_order_info',$all_order_info);
      return view('admin_layout')->with('admin.manage_order',$manage_order);
   }
   public function view_order($order_id)
   {
      $order_by_id = DB::table('tbl_order')
                        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
                        ->join('tbl_order_detail','tbl_order.order_id','=','tbl_order_detail.order_id')
                        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
                        ->join('tbl_product','tbl_order_detail.product_id','=','tbl_product.product_id')
                        ->select('tbl_order.*','tbl_order_detail.*','tbl_shipping.*','tbl_customer.*','tbl_product.*')
                        ->where('tbl_order.order_id',$order_id)
                        ->get();
      $view_order = view('admin.view_order')
      ->with('order_by_id',$order_by_id);
      return view('admin_layout')->with('admin.view_order',$view_order);
   }
   public function delete_order($order_id)
    {
      DB::table('tbl_order')
         ->where('order_id',$order_id)
         ->delete();
      Session::get('message','Order Deleted Successfully');
      return Redirect::to('/manage_order');
    }
   public function customer_logout()
   {
   	Session::flush();
   	return Redirect::to('/');
   }


}
