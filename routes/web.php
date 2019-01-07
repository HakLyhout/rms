<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Frontend Route........................................
// Route::get('/', 'HomeController@index');


// //show product by id
// Route::get('/view_product/{product_id}','HomeController@product_details_by_id');
// Route::post('/add_to_cart','CartController@add_to_cart');
// Route::get('/show_cart','CartController@show_cart');
// Route::get('/delete-to-cart/{rowId}','CartController@delete_to_cart');
// Route::post('/update-cart','CartController@update_cart');

// //Check out
// Route::get('/login','CheckoutController@log_in');
// Route::post('/customer_registration','CheckoutController@customer_registration');
// Route::get('/checkout','CheckoutController@checkout');
// Route::post('/shipping','CheckoutController@shipping');
// Route::post('/customer_login','CheckoutController@customer_login');
// Route::get('/customer_logout','CheckoutController@customer_logout');

// Route::get('/payment','CheckoutController@payment');
// Route::post('/order_place','CheckoutController@order_place');
// Route::get('/manage_order','CheckoutController@manage_order');
// Route::get('/view_order/{order_id}','CheckoutController@view_order');
// Route::get('/delete_order/{order_id}','CheckoutController@delete_order');


// Backend Route..........................................
Route::get('/dashboard','SuperAdminController@index');
Route::get('/','AdminController@index');
Route::post('/admin-dashboard','AdminController@dashboard');
Route::get('/logout','SuperAdminController@logout');

// Ad Type
Route::get('/categories','CategoriesController@all_categories');
// Route::get('/all-categories','CategoriesController@all_categories');
Route::post('/save-category','CategoriesController@save_categories');
Route::get('/edit_category/{id}','CategoriesController@edit_categories');
Route::post('/update_category/{id}','CategoriesController@update_categories');
Route::get('/delete_category/{id}','CategoriesController@delete_categories');
// Route::get('/unactive_category/{id}','CategoriesController@unactive_categories');
// Route::get('/active_category/{id}','CategoriesController@active_categories');

// Report Listing
Route::get('/listing','ListingController@all_listing');
Route::get('/add_listing','ListingController@index');
Route::post('/save-listing','ListingController@save_listing');
Route::get('/edit_listing/{report_id}','ListingController@edit_listing');
Route::post('/update_listing/{report_id}','ListingController@update_listing');
Route::get('/delete_listing/{report_id}','ListingController@delete_listing');
Route::get('/unactive_listing/{report_id}','ListingController@unactive_listing');
Route::get('/active_listing/{report_id}','ListingController@active_listing');

Route::get('/make_report','ListingController@all_datapost');
Route::get('/import_file','ListingController@postImport');
Route::get('/export_report','ListingController@getExport');

//Data View
Route::post('/postdata','ListingController@postdata');
Route::get('/delete_data/{data_id}','ListingController@delete_data');
Route::get('/edit_data/{data_id}','ListingController@edit_data');
Route::post('/update_data/{data_id}','ListingController@update_data');
//Data Car
Route::get('/number_car','ListingController@all_carpost');
Route::post('/postcar','ListingController@postcar');
Route::get('/delete_data_car/{data_car_id}','ListingController@delete_data_car');
Route::get('/edit_data_car/{data_car_id}','ListingController@edit_data_car');
Route::post('/update_data_car/{data_car_id}','ListingController@update_data_car');
//Data Service
Route::get('/number_service','ListingController@all_servicepost');
Route::post('/postservice','ListingController@postservice');
Route::get('/delete_data_service/{data_service_id}','ListingController@delete_data_service');
Route::get('/edit_data_service/{data_service_id}','ListingController@edit_data_service');
Route::post('/update_data_service/{data_service_id}','ListingController@update_data_service');

// Export Report
// Route::get('/export','ListingController@export_report');
Route::get('/postfilter/{report_id}','ListingController@postfilter');
// Route::get('/filter_export/{report_id}','ListingController@filter_export');
Route::get('/report/pdf/{report_id}','ListingController@export_pdf');

//Report Type
Route::get('/reports','ReportController@all_reports');
// Route::get('/all-categories','ReportController@all_reports');
Route::post('/save-reports','ReportController@save_reports');
Route::get('/edit_reports/{id}','ReportController@edit_reports');
Route::post('/update_reports/{id}','ReportController@update_reports');
Route::get('/delete_reports/{id}','ReportController@delete_reports');
// Route::get('/unactive_category/{id}','ReportController@unactive_reports');
// Route::get('/active_category/{id}','ReportController@active_reports');

//payment Status
Route::get('/payments','PaymentController@all_payments');
// Route::get('/all-categories','ReportController@all_reports');
Route::post('/save-payments','PaymentController@save_payments');
Route::get('/edit_payments/{id}','PaymentController@edit_payments');
Route::post('/update_payments/{id}','PaymentController@update_payments');
Route::get('/delete_payments/{id}','PaymentController@delete_payments');
// Route::get('/unactive_category/{id}','ReportController@unactive_reports');
// Route::get('/active_category/{id}','ReportController@active_reports');

//User Type
Route::get('/usertypes','UsertypeController@all_usertypes');
// Route::get('/all-categories','ReportController@all_reports');
Route::post('/save-usertypes','UsertypeController@save_usertypes');
Route::get('/edit_usertypes/{id}','UsertypeController@edit_usertypes');
Route::post('/update_usertypes/{id}','UsertypeController@update_usertypes');
Route::get('/delete_usertypes/{id}','UsertypeController@delete_usertypes');
// Route::get('/unactive_category/{id}','ReportController@unactive_reports');
// Route::get('/active_category/{id}','ReportController@active_reports');

// User Role Route
Route::get('/role','RoleController@all_role');
//Route::get('/all-role','RoleController@all_role');
Route::post('/save-role','RoleController@save_role');
Route::get('/edit_role/{id}','RoleController@edit_role');
Route::post('/update_role/{id}','RoleController@update_role');
Route::get('/delete_role/{id}','RoleController@delete_role');
// Route::get('/unactive_role/{id}','RoleController@unactive_role');
// Route::get('/active_role/{id}','RoleController@active_role');

//product route
// Route::get('/product','ProductController@index');
// Route::get('/all-product','ProductController@all_product');
// Route::post('/save-product','ProductController@save_product');
// Route::get('/unactive_product/{id}','ProductController@unactive_product');
// Route::get('/active_product/{id}','ProductController@active_product');
// Route::get('/delete_product/{id}','ProductController@delete_product');
// Route::get('/edit_product/{id}','ProductController@edit_product');
// Route::post('/update_product/{id}','ProductController@update_product');

//slide route
// Route::get('/slide','SlideController@index');
// Route::get('/all-slide','SlideController@all_slide');
// Route::get('/save-slide','SlideController@save_slide');
// Route::get('/unactive_slide','SlideController@unactive_slide');
// Route::get('/active_slide','SlideController@active_slide');
// Route::get('/delete','SlideController@delete_product');