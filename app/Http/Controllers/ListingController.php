<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use File;
use App\Http\Requests;
use App\DataReport;
use Session;
use Charts;
use PDF;
use App\Report;
use Illuminate\Support\Facades\Redirect;
session_start();

class ListingController extends Controller
{
    function index()
    {
        $this->AdminAuthCheck();
    	return view('admin.add_listing');
    }
    function all_listing()
    {
        $this->AdminAuthCheck();
        $all_listing_info = DB::table('report_ad')
                            ->join('ad_status','report_ad.ad_status_id','=','ad_status.ad_status_id')
                            ->join('ad_type','report_ad.ad_type_id','=','ad_type.ad_type_id')
                            ->join('report_type','report_ad.report_type_id','=','report_type.report_type_id')
                            ->join('main_type','report_ad.main_type_id','=','main_type.main_type_id')
                            ->select('report_ad.*','ad_status.ad_status_name','ad_type.ad_type_name','report_type.report_type_name','main_type.main_type_id')
                            ->get();
    	$manage_listing = view('admin.listing')
    	->with('all_listing_info',$all_listing_info);

    	return view('admin_layout')->with('admin.listing',$manage_listing);
    	// return view('admin.all_categories');
    }
    function save_listing(Request $request)
    {
    	$data = array();
    	$data['report_id'] = $request->id;
        $data['name'] = $request->listing_name;
        $data['type_name'] = $request->listing_type_name;
        $data['start_date'] = $request->listing_start_date;
        $data['end_date'] = $request->listing_end_date;
        $data['status'] = $request->listing_status;
        $data['ad_status_id'] = $request->listing_ad_status_id;
        $data['ad_type_id'] = $request->listing_ad_type_id;
        $data['report_type_id'] = $request->listing_report_type_id;
        $data['main_type_id'] = $request->listing_main_type_id;
        // $data['import_field'] = $request->listing_import_field;
        $data['status'] = $request->listing_status;
        $data['created_at'] = $request->listing_created_at;
        // $file = $request->file('listing_import_field');

        // if($file)
        // {
        //     $file_name = str_random(20);
        //     $ext = strtolower($file->getClientOriginalExtension());
        //     $file_full_name = $file_name.'.'.$ext;
        //     $upload_path = "file/";
        //     $file_url = $upload_path.$file_full_name;
        //     $success = $file->move($upload_path,$file_full_name);
        //     if($success)
        //     {
        //         $data['import_file'] = $file_url;
        //         DB::table('report_ad')->insert($data);
        //         Session::put('message','<p class="alert alert-success">Listing added Successfully !</p>');
        //         return Redirect::to('/listing');
        //     }

        // }
        // $data['import_file'] ='';
    	DB::table('report_ad')->insert($data);
    	Session::put('message','<p class="alert alert-success">Listing added Successfully !</p>');
    	return Redirect::to('/listing');

    }
    function unactive_listing($report_id)
    {
    	DB::table('report_ad')
    	->where('report_id',$report_id)
    	->update(['status'=>0]);
    	Session::put('message','<p class="alert alert-danger">This Listing is Unactive !</p>');
    	return Redirect::to('/listing');
    }

    function active_listing($report_id)
    {
    	DB::table('report_ad')
    	->where('report_id',$report_id)
    	->update(['status'=>1]);
    	Session::put('message','<p class="alert alert-success">This Listing is active !</p>');
    	return Redirect::to('/listing');
    }
    
    function edit_listing($report_id)
    {
        $listing_info = DB::table('report_ad')
            ->join('ad_status','report_ad.ad_status_id','=','ad_status.ad_status_id')
            ->join('ad_type','report_ad.ad_type_id','=','ad_type.ad_type_id')
            ->join('report_type','report_ad.report_type_id','=','report_type.report_type_id')
            ->join('main_type','report_ad.main_type_id','=','main_type.main_type_id')
            ->select('report_ad.*','ad_status.ad_status_name','ad_type.ad_type_name','report_type.report_type_name','main_type.main_type_name')
    		->where('report_id',$report_id)
    		->first();
        $listing_info = view('admin.edit_listing')
    		->with('listing_info',$listing_info);
    	return view('admin_layout')
    		->with('admin.edit_listing',$listing_info);
    	//return view('admin.edit_categories');
    }
    function update_listing(Request $request,$report_id)
    {
    	$data = array();
        $data['name'] = $request->listing_name;
        $data['type_name'] = $request->listing_type_name;
        $data['start_date'] = $request->listing_start_date;
        $data['end_date'] = $request->listing_end_date;
        // $data['status'] = $request->listing_status;
        $data['ad_status_id'] = $request->listing_ad_status_id;
        $data['ad_type_id'] = $request->listing_ad_type_id;
        $data['report_type_id'] = $request->listing_report_type_id;
        $data['main_type_id'] = $request->listing_main_type_id;
        // $data['import_field'] = $request->listing_import_field;
        $data['updated_at'] = $request->listing_updated_at;
        $file = $request->file('listing_import_field');

        // if($file)
        // {   
        //     $image = DB::table('report_ad')->where('report_id', $report_id)->first();
        //     $file= $image->import_file;
        //     $filename = public_path().'/'.$file;
        //     $success = File::delete($filename);

        //     $file_name = str_random(20);
        //     $ext = strtolower($file->getClientOriginalExtension());
        //     $file_full_name = $file_name.'.'.$ext;
        //     $upload_path = "file/";
        //     $file_url = $upload_path.$file_full_name;
        //     $success = $file->move($upload_path,$file_full_name);
        //     if($success)
        //     {
                // $data['import_file'] = $file_url;
                // DB::table('report_ad')->where('report_id',$report_id)
                //                         ->update($data);
                // Session::put('message','<p class="alert alert-success">This Listing is updated</p>');
                // return Redirect::to('/listing');
            // }

        // }
        // $data['import_file'] ='';
    	DB::table('report_ad')
    		->where('report_id',$report_id)
    		->update($data);

    	Session::put('message','<p class="alert alert-success">This Listing is updated</p>');
    	return Redirect::to('/listing');
    }
    function delete_listing($report_id)
    {   
        // $image = DB::table('report_ad')->where('report_id', $report_id)->first();
        // $file= $image->import_file;
        // $filename = public_path().'/'.$file;
        // $success = File::delete($filename);
        // if($success)
        //     {
            DB::table('report_ad')
                ->where('report_id',$report_id)
                ->delete();
            DB::table('data_report')
                ->where('report_id',$report_id)
                ->delete();
            DB::table('data_car')
                ->where('report_id',$report_id)
                ->delete();
            Session::get('message','<p class="alert alert-danger">Product is Deleted</p>');
           
        // }
        return Redirect::to('/listing');
    }
    //Import & Export Report As Excel
    function make_report($report_id){
        $this->AdminAuthCheck();
        return view('admin.data_listing');
    }
    function postImport(){
        Excel::load(Input::file('excel'),function($reader){
            $reader->each(function($sheet){
                Customer::firstOrCreate($sheet->toArray());
            });
        });
        return back();
    }
    function export_report(){
        $this->AdminAuthCheck();
        return view('admin.export');
    }
    function getExport(){
        $customer= Customer::all();
        Excel::create('Export Data',function($excel) use($customer){
                $excel->sheet('Sheet1',function($sheet) use($customer){
                    $sheet->fromArrray($cutomer);
                });
        });
    }
    //data insert batch
    function postdata(Request $request)
    {
        $data = array();
        $data['data_id'] = $request->id;
        $data['report_id']= $request->report_id;
        $data['date'] = $request->date;
        $data['view'] = $request->view;
        $data['interest_view'] =$request->interest_view;
        $data['created_at'] = $request->data_created_at;
    	// $data['report_type_name'] = $request->report_type_name;
    	// $data['publication_status'] = $request->publication_status;

    	DB::table('data_report')->insert($data);
        Session::put('message','<p class="alert alert-success">Data added Successfully !</p>');
    	return Redirect::to('/make_report');
    }
    function all_datapost()
    {
        $this->AdminAuthCheck();
        $all_addmore_info = DB::table('data_report')
                            ->join('report_ad','data_report.report_id','=','report_ad.report_id')
                            ->select('data_report.*','report_ad.name')
                            ->get();
        // $all_addmore_info = DB::table('data_report')->get();
    	$manage_addmore = view('admin.data_listing')
    	->with('all_addmore_info',$all_addmore_info);

    	return view('admin_layout')->with('admin.data_listing',$manage_addmore);
    	// return view('admin.all_categories');
    }
    function edit_data($data_id)
    {
    	$data_info = DB::table('data_report')
    		->where('data_id',$data_id)
    		->first();
    	$data_info = view('admin.edit_data_listing')
    		->with('data_info',$data_info);
    	return view('admin_layout')
    		->with('admin.edit_data_listing',$data_info);
    	//return view('admin.edit_categories');
    }
   function update_data(Request $request,$data_id)
    {
    	$data = array();
    	$data['date'] = $request->date;
        $data['view'] = $request->view;
        $data['interest_view'] = $request->interest_view;
        $data['updated_at'] = $request->updated_at;
    	DB::table('data_report')
    		->where('data_id',$data_id)
    		->update($data);

    	Session::put('message','<p class="alert alert-success">Data is updated</p>');
    	return Redirect::to('/make_report');
    }
    function delete_data($data_id)
    {
    	DB::table('data_report')
    		->where('data_id',$data_id)
    		->delete();
    	Session::get('message','<p class="alert alert-success">Data Deleted Successfully</p>');
    	return Redirect::to('/make_report');
    }
    // Number of Car
    function postcar(Request $request)
    {
        $data = array();
        $data['data_car_id'] = $request->id;
        $data['report_id']= $request->report_id;
        $data['all_listing_car'] = $request->all_listing_car;
        $data['active_car'] = $request->active_car;
        $data['urgent_car'] =$request->urgent_car;
        $data['sold_car'] = $data['all_listing_car']-$data['active_car'];
        $data['created_at'] = $request->data_created_at;
    	// $data['report_type_name'] = $request->report_type_name;
    	// $data['publication_status'] = $request->publication_status;

    	DB::table('data_car')->insert($data);
        Session::put('message','<p class="alert alert-success">Data Car added Successfully !</p>');
    	return Redirect::to('/make_report');
    }
     function all_carpost()
    {
        $this->AdminAuthCheck();
        $all_car_info = DB::table('data_car')
                            ->join('report_ad','data_car.report_id','=','report_ad.report_id')
                            ->select('data_car.*','report_ad.name')
                            ->get();
    	$manage_car = view('admin.data_car_listing')
    	->with('all_car_info',$all_car_info);

    	return view('admin_layout')->with('admin.data_car_listing',$manage_car);
    	// return view('admin.all_categories');
    }
    function edit_data_car($data_car_id)
    {
        $data_car_info = DB::table('data_car')
            ->join('report_ad','data_car.report_id','=','report_ad.report_id')
            ->select('data_car.*','report_ad.name')
    		->where('data_car_id',$data_car_id)
    		->first();
    	$data_car_info = view('admin.edit_data_car_listing')
    		->with('data_car_info',$data_car_info);
    	return view('admin_layout')
    		->with('admin.edit_data_car_listing',$data_car_info);
    	//return view('admin.edit_categories');
    }
    function update_data_car(Request $request,$data_car_id)
    {
    	$data = array();
    	$data['all_listing_car'] = $request->all_listing_car;
        $data['active_car'] = $request->active_car;
        $data['urgent_car'] = $request->urgent_car;
        $data['sold_car'] = $data['all_listing_car']-$data['active_car'];
        $data['updated_at'] = $request->updated_at;
    	DB::table('data_car')
    		->where('data_car_id',$data_car_id)
    		->update($data);

    	Session::put('message','<p class="alert alert-success">Data Car is updated</p>');
    	return Redirect::to('/make_report');
    }
    function delete_data_car($data_car_id)
    {
    	DB::table('data_car')
    		->where('data_car_id',$data_car_id)
    		->delete();
    	Session::get('message','<p class="alert alert-success">Data Car Deleted Successfully</p>');
    	return Redirect::to('/make_report');
    }
     // Number of Service
    function postservice(Request $request)
     {
         $data = array();
         $data['data_service_id'] = $request->id;
         $data['report_id']= $request->report_id;
         $data['all_listing_service'] = $request->all_listing_service;
         $data['active_service'] = $request->active_service;
         $data['urgent_service'] =$request->urgent_service;
         $data['created_at'] = $request->data_created_at;
         // $data['report_type_name'] = $request->report_type_name;
         // $data['publication_status'] = $request->publication_status;
 
         DB::table('data_service')->insert($data);
         Session::put('message','<p class="alert alert-success">Data Service added Successfully !</p>');
         return Redirect::to('/make_report');
     }
      function all_servicepost()
     {
         $this->AdminAuthCheck();
         $all_service_info = DB::table('data_service')
                             ->join('report_ad','data_service.report_id','=','report_ad.report_id')
                             ->select('data_service.*','report_ad.name')
                             ->get();
         $manage_service = view('admin.data_service_listing')
         ->with('all_service_info',$all_service_info);
 
         return view('admin_layout')->with('admin.data_service_listing',$manage_service);
         // return view('admin.all_categories');
     }
      function edit_data_service($data_service_id)
     {
         $data_service_info = DB::table('data_service')
             ->join('report_ad','data_service.report_id','=','report_ad.report_id')
             ->select('data_service.*','report_ad.name')
             ->where('data_service_id',$data_service_id)
             ->first();
         $data_service_info = view('admin.edit_data_service_listing')
             ->with('data_service_info',$data_service_info);
         return view('admin_layout')
             ->with('admin.edit_data_service_listing',$data_service_info);
         //return view('admin.edit_categories');
     }
    function update_data_service(Request $request,$data_service_id)
     {
         $data = array();
         $data['all_listing_service'] = $request->all_listing_service;
         $data['active_service'] = $request->active_service;
         $data['urgent_service'] = $request->urgent_service;
         $data['updated_at'] = $request->updated_at;
         DB::table('data_service')
             ->where('data_service_id',$data_service_id)
             ->update($data);
 
         Session::put('message','<p class="alert alert-success">Data Service is updated</p>');
         return Redirect::to('/make_report');
     }
    function delete_data_service($data_service_id)
     {
         DB::table('data_service')
             ->where('data_service_id',$data_service_id)
             ->delete();
         Session::get('message','<p class="alert alert-success">Data Service Deleted Successfully</p>');
         return Redirect::to('/make_report');
     }
     //filter Export Report
    function postfilter($report_id)
    {
        $this->AdminAuthCheck();
        $all_filter_report = DB::table('report_ad')
            ->join('ad_type','report_ad.ad_type_id','=','ad_type.ad_type_id')
            ->join('ad_status','report_ad.ad_status_id','=','ad_status.ad_status_id')
            ->join('main_type','report_ad.main_type_id','=','main_type.main_type_id')
            ->join('report_type','report_ad.report_type_id','=','report_type.report_type_id')
            ->select('report_ad.*',
                'ad_type.ad_type_name',
                'ad_status.ad_status_name',
                'main_type.main_type_name',
                'main_type.main_type_name',
                'report_type.report_type_name')
            ->where('report_ad.report_id',$report_id)
            ->get();

        // $manage_filter_report = view('admin.filter_export')
        //     ->with('all_filter_report',$all_filter_report);

        $all_data_report = DB::table('data_report')
            // ->join('report_ad','data_report.report_id','=','report_ad.report_id')
            // ->select('date as created_at','view as views')
            ->where('data_report.report_id',$report_id)
            ->get();

        $all_car_report = DB::table('data_car')
            ->join('report_ad','data_car.report_id','=','report_ad.report_id')
            ->select('data_car.*','report_ad.name')
            ->where('data_car.report_id',$report_id)
            ->get();
        
        $all_service_report = DB::table('data_service')
            ->join('report_ad','data_service.report_id','=','report_ad.report_id')
            ->select('data_service.*','report_ad.name')
            ->where('data_service.report_id',$report_id)
            ->get();   

        $chart = Charts::create('area', 'highcharts')
                ->title("Viewer")
                ->elementLabel("Total Users")
                ->labels(['created_at'])
                ->values(['views'])
                ->dimensions(1000, 500)
                ->responsive(false)
                ->labels($all_data_report->pluck('date'))
                ->values($all_data_report->pluck('view'));
        $chart_interest = Charts::create('area', 'highcharts')
                ->title("Interest Viewer")
                ->elementLabel("Total Users")
                ->labels(['created_at'])
                ->values(['views'])
                ->dimensions(1000, 500)
                ->responsive(false)
                ->labels($all_data_report->pluck('date'))
                ->values($all_data_report->pluck('interest_view'));
                // ->groupByMonth(date('Y'), true);
        // $chart =Charts::create($all_data_report,'area', 'highcharts')
        //             ->title('My nice chart')
        //             ->elementLabel('My nice label')
        //             ->labels(['created_at'])
        //             ->values(['views'])
        //             ->dimensions(1000,500)
        //             ->responsive(false);
        $manage_data_report = view('admin.filter_export')
                ->with('all_filter_report',$all_filter_report)
                ->with('all_data_report',$all_data_report)
                ->with('all_car_report',$all_car_report)
                ->with('all_service_report',$all_service_report)
                ->with('chart',$chart)
                ->with('chart_interest',$chart_interest);
                
        
        // return view('admin_layout')->with('admin.',$manage_filter_report);
      
        
        return view('admin_layout')->with('admin.',$manage_data_report);
       
     }
    //  public function export_pdf()
    // {
        // Fetch all customers from database
        // $data = Report::get();
        // $pdf = PDF::loadView('admin.', $data);
        // If you want to store the generated pdf to the server then you can use the store function
        // $pdf->save(storage_path().'_filename.pdf');
        // Finally, you can download the file usinl.g download function
        // return $pdf->download('customers.pdf');
   // }
  
    function get_customer_data($report_id)
    {
        $all_filter_report = DB::table('report_ad')
        ->join('ad_type','report_ad.ad_type_id','=','ad_type.ad_type_id')
        ->join('ad_status','report_ad.ad_status_id','=','ad_status.ad_status_id')
        ->join('main_type','report_ad.main_type_id','=','main_type.main_type_id')
        ->join('report_type','report_ad.report_type_id','=','report_type.report_type_id')
        ->select('report_ad.*',
            'ad_type.ad_type_name',
            'ad_status.ad_status_name',
            'main_type.main_type_name',
            'report_type.report_type_name')
        ->where('report_ad.report_id',$report_id)
        ->get();

        return $all_filter_report;
    }
    function get_customer_car($report_id)
    {
        $all_car_report = DB::table('data_car')
            ->join('report_ad','data_car.report_id','=','report_ad.report_id')
            ->select('data_car.*','report_ad.name')
            ->where('data_car.report_id',$report_id)
            ->get();
        return $all_car_report;
    }
    function get_customer_service($report_id)
    {
        $all_service_report = DB::table('data_service')
            ->join('report_ad','data_service.report_id','=','report_ad.report_id')
            ->select('data_service.*','report_ad.name')
            ->where('data_service.report_id',$report_id)
            ->get();   
   
        return $all_service_report;
    }
    function get_customer_view($report_id)
    {
        $all_data_report = DB::table('data_report')
            ->where('data_report.report_id',$report_id)
            ->get();
        $chart = Charts::create('area', 'highcharts')
            ->title("Viewer")
            ->elementLabel("Total Users")
            ->labels(['created_at'])
            ->values(['views'])
            ->dimensions(1000, 500)
            ->responsive(false)
            ->labels($all_data_report->pluck('date'))
            ->values($all_data_report->pluck('view'));
   
        return $chart;
    }
    function get_customer_interest($report_id)
    {
        $all_data_report = DB::table('data_report')
            ->where('data_report.report_id',$report_id)
            ->get();
        $chart_interest = Charts::create('area', 'highcharts')
            ->title("Interest Viewer")
            ->elementLabel("Total Users")
            ->labels(['created_at'])
            ->values(['views'])
            ->dimensions(1000, 500)
            ->responsive(false)
            ->labels($all_data_report->pluck('date'))
            ->values($all_data_report->pluck('interest_view'));
        return $chart_interest;
    }
    function export_pdf($report_id)
        {
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($this->convert_customer_data_to_html($report_id));
            return $pdf->stream();
        }
    function convert_customer_data_to_html($report_id)
    {   
        $customer_data = $this->get_customer_data($report_id);
        $car_data = $this->get_customer_car($report_id);
        $service_data = $this->get_customer_service($report_id);
        $chart = $this->get_customer_view($report_id);
        $chart_interest= $this->get_customer_interest($report_id);
        

        $output = '
        
        <h3 align="center">Customer Data</h3>
        <table width="100%" class="table" style="border-collapse: collapse; border: 0px;">
            <tr>
                <th style="border: 1px solid; padding:12px;" width="20%">Name</th>
                <th style="border: 1px solid; padding:12px;" width="30%">Start date</th>
                <th style="border: 1px solid; padding:12px;" width="15%">End date</th>
                <th style="border: 1px solid; padding:12px;" width="15%">Ad Type</th>
                <th style="border: 1px solid; padding:12px;" width="15%">Ad Status</th>
                <th style="border: 1px solid; padding:12px;" width="15%">Main Type</th>
                <th style="border: 1px solid; padding:12px;" width="15%">Report Type</th>
                
            </tr>
        
        ';

        foreach($customer_data as $customer)
        {
            $output .= '
            <tr>
                <td style="border: 1px solid; padding:12px;">'.$customer->name.'</td>
                <td style="border: 1px solid; padding:12px;">'.$customer->start_date.'</td>
                <td style="border: 1px solid; padding:12px;">'.$customer->end_date.'</td>
                <td style="border: 1px solid; padding:12px;">'.$customer->ad_type_name.'</td>
                <td style="border: 1px solid; padding:12px;">'.$customer->ad_status_name.'</td>
                <td style="border: 1px solid; padding:12px;">'.$customer->main_type_name.'</td>
                <td style="border: 1px solid; padding:12px;">'.$customer->report_type_name.'</td>
               
            </tr>
        </table>
        <br>
        <br>
        <br>
        ';
            if($customer->main_type_id ==1){
                $output .= '
                <table width="100%" class="table" style="border-collapse: collapse; border: 0px;">
                    <tr>
                        <th style="border: 1px solid; padding:12px;" width="20%">All Listing Car</th>
                        <th style="border: 1px solid; padding:12px;" width="30%">Active Car</th>
                        <th style="border: 1px solid; padding:12px;" width="15%">Hot Deal</th>
                        <th style="border: 1px solid; padding:12px;" width="15%">Sold Car</th>
                    </tr>
                ';
                foreach($car_data as $car)
                {
                    $output .= '
                    <tr>
                        <td style="border: 1px solid; padding:12px;">'.$car->all_listing_car.'</td>
                        <td style="border: 1px solid; padding:12px;">'.$car->active_car.'</td>
                        <td style="border: 1px solid; padding:12px;">'.$car->urgent_car.'</td>
                        <td style="border: 1px solid; padding:12px;">'.$car->sold_car.'</td>               
                    </tr>
                ';
                }
                $output .='
                    <div class="row">
                    '.Charts::styles().'
                        <div class="col-sm-6">
                            '.$chart->html().'
                        </div>
                         <div class="col-sm-6">
                            '.$chart_interest->html().'
                        </div>
                    </div>
                    {!!Charts::scripts()!!}

                    {!!$chart->script()!!}
                    {!!$chart_interest->script()!!}
                        ';
            }else{ 
                $output .= '
                <table width="100%" class="table" style="border-collapse: collapse; border: 0px;">
                    <tr>
                        <th style="border: 1px solid; padding:12px;" width="20%">All Listing Service</th>
                        <th style="border: 1px solid; padding:12px;" width="30%">Active Service</th>
                        <th style="border: 1px solid; padding:12px;" width="15%">Hot Deal</th>
                  
                    </tr>
                ';
                foreach($service_data as $service)
                {
                    $output .= '
                    <tr>
                        <td style="border: 1px solid; padding:12px;">'.$service->all_listing_service.'</td>
                        <td style="border: 1px solid; padding:12px;">'.$service->active_service.'</td>
                        <td style="border: 1px solid; padding:12px;">'.$service->urgent_service.'</td>
                   
                    </tr>
                ';
                }
                 $output .='
                    <div class="row">
                        <div class="col-sm-6">

                            '.$chart->html().'
                        </div>
                         <div class="col-sm-6">
                            '.$chart_interest->html().'
                        </div>
                    </div>
                ';
            }
        }
        
        $output .= '</table>';
        return $output;
    }
    //User Session
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
