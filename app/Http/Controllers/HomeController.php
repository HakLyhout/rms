<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
class HomeController extends Controller
{
    public function index()
    {
    	$all_published_product = DB::table('tbl_product')
    			->join('tbl_category','tbl_product.category_id','=','tbl_category.id')
    			->join('tbl_manufacture','tbl_product.manufacture_id','=','tbl_manufacture.manufacture_id')
    			->select('tbl_product.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
    			->where('tbl_product.publication_status',1)
    			->limit(8)
    			->get();
    	$manage_published_product = view('pages.home')
    			->with('all_published_product',$all_published_product);
    	return view('layout')
    			->with('pages.home',$manage_published_product);
    	// return view('pages.home');
    }
    public function product_details_by_id($product_id)
    {
        $product_by_details = DB::table('tbl_product')
                            ->join('tbl_category','tbl_product.category_id','=','tbl_category.id')
                            ->join('tbl_manufacture','tbl_product.manufacture_id','=','tbl_manufacture.manufacture_id')
                            ->select('tbl_product.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
                            ->where('tbl_product.product_id',$product_id)
                            ->where('tbl_product.publication_status',1)
                            ->first();
        $manage_product_by_details = view('pages.view_product')
                            ->with('product_by_details',$product_by_details);
        return view('layout')
            ->with('pages.view_product',$manage_product_by_details);
    }
}
