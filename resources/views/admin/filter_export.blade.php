@extends('admin_layout')
@section('content')

			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Tables</a></li>
			</ul>
				
				<?php
					$message = Session::get('message');

					if($message)
					{
						
						echo $message;
						Session::put('message',NULL);

					}
				?>
			<!-- Number of Car -->
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Number of Cars</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-down"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
							@foreach( $all_filter_report as $v_report )
							<div class="row-fluid">
								<a href="{{ URL::to('/report/pdf',$v_report->report_id)}}" class="btn btnprn btn-success">Export</a>
							</div>
							<form>
								<table class="table table-striped table-bordered bootstrap-datatable">
									<thead>
										<tr>
											<th>Dealer</th>
											<th>Ad Status</th>
											<th>Ad Type</th>
											<th>Report Type</th>
											<th>Categories</th>
										</tr>
									</thead>   
								
									<tbody>
										<tr>
											<td class="center">{{$v_report->name}}</td>
											<td class="center">{{$v_report->ad_status_name}}</td>
											<td class="center">{{$v_report->ad_type_name}}</td>
											<td class="center">{{$v_report->report_type_name}}</td>
											<td class="center">{{$v_report->main_type_name}}</td>
										</tr>
									</tbody>
								</table>  
								@if($v_report->main_type_id ==1 ) 
									@foreach( $all_car_report as $v_car )
										<table class="table table-striped table-bordered bootstrap-datatable">
											<thead>
												<tr>
													<th>All Listing Car</th>
													<th>Active Car</th>
													<th>Urgent Car</th>
													<th>Sold Car</th>
												</tr>
											</thead>   
										
											<tbody>
												<tr>
													<td class="center">{{$v_car->all_listing_car}}</td>
													<td class="center">{{$v_car->active_car}}</td>
													<td class="center">{{$v_car->urgent_car}}</td>
													<td class="center">{{$v_car->sold_car}}</td>
												</tr>
											</tbody>
										</table>
									@endforeach  
									<div class="row-fluid">
									{!! $chart->html() !!}
									
									{!! $chart_interest->html() !!}
										<!-- <div class="widget span6" onTablet="span6" onDesktop="span6">
											<h2><span class="glyphicons view"><i></i></span>Car View</h2>
											<hr>
											<div class="content">
												<div id="facebookChart" style="height:300px" ></div>
											</div>
										</div>
										
										<div class="widget span6" onTablet="span6" onDesktop="span6">
											<h2><span class="glyphicons call"><i></i></span>Car Interest View</h2>
											<hr>
											<div class="content">
												<div id="twitterChart" style="height:300px" ></div>
											</div>
										</div>-->
									
									</div>
								@else
									@foreach( $all_service_report as $v_service )
										<table class="table table-striped table-bordered bootstrap-datatable">
											<thead>
												<tr>
													<th>All Listing Service</th>
													<th>Active Service</th>
													<th>Urgent Car</th>
												</tr>
											</thead>   
										
											<tbody>
												<tr>
													<td class="center">{{$v_service->all_listing_service}}</td>
													<td class="center">{{$v_service->active_service}}</td>
													<td class="center">{{$v_service->urgent_service}}</td>
												</tr>
											</tbody>
										</table>
									@endforeach    
									<div class="row-fluid">
									{!! $chart->html() !!}
									{!! $chart_interest->html() !!}
										<!-- <div class="widget span6" onTablet="span6" onDesktop="span6">
											<h2><span class="glyphicons view"><i></i></span>Car View</h2>
											<hr>
											<div class="content">
												<div id="facebookChart" style="height:300px" ></div>
											</div>
										</div>
										
										<div class="widget span6" onTablet="span6" onDesktop="span6">
											<h2><span class="glyphicons call"><i></i></span>Car Interest View</h2>
											<hr>
											<div class="content">
												<div id="twitterChart" style="height:300px" ></div>
											</div>
										</div>-->
									
									</div>
								@endif
							</form>
							@endforeach  
					</div>
				</div><!--/span-->
			
            </div><!--/row-->
			
			<!--  -->
			{!! Charts::scripts() !!}

        	{!! $chart->script() !!}
			{!! $chart_interest->script() !!}
@endsection