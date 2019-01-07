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
			</p>
			<div class="row-fluid">
				<a href="{{URL::to('/add_listing')}}" class="btn btn-info">Add More</a>
			</div>
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Listing ID</th>
								  <th>Listing Dealer</th>
                                  <th>Listing Name</th>
                                  <th>Listing payment</th>
                                  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  @foreach( $all_listing_info as $v_listing)
						  <tbody>
							<tr>
								<td>{{ $v_listing->report_id }}</td>
								<td class="center">{{ $v_listing->name}}</td>
                                <td class="center">{{ $v_listing->type_name}}</td>
                                <td class="center">{{ $v_listing->ad_status_name}}</td>
                                <td class="center">
									@if($v_listing->status ==1 )
										<span class="label label-success">Active</span>
									@else
										<span class="label label-danger">Unactive</span>
									@endif
								</td>
								<td class="center">
									@if($v_listing->status == 1)
										<a class="btn btn-success" href="{{ URL::to('/unactive_listing/'.$v_listing->report_id)}}">
											<i class="halflings-icon white thumbs-down"></i>  
										</a>
									@else
										<a class="btn btn-danger" href="{{ URL::to('/active_listing/'.$v_listing->report_id)}}">
											<i class="halflings-icon white thumbs-up"></i>  
										</a>
									@endif
										<a class="btn btn-info" href="{{ URL::to('/edit_listing/'.$v_listing->report_id)}}">
											<i class="halflings-icon white edit "></i> 
										</a>
										<a class="btn btn-danger" href="{{ URL::to('/delete_listing/'.$v_listing->report_id)}}">
											<i class="halflings-icon white trash"></i> 
										</a>
										<a class="btn btn-success"  href="{{URL::to('/postfilter/'.$v_listing->report_id)}}">
											<i class="halflings-icon white export"></i> 
										</a>
								</td>
							</tr>
						  </tbody>
						  @endforeach
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<!-- <div class="modal hide fade" id="myModal">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h3>Add Payment Types</h3>
				</div>
				<form class="form-horizontal" action="{{ url('/save-payments')}}" method="post">
							{{ csrf_field() }}
					<div class="modal-body">
						<div class="form-group">
						    <label for="role">Payment Type Name:</label>
						    <input type="text" name="ad_status_name" class="form-control" id="payment_type" required>
						</div>
					</div>
					<div class="modal-footer">
						<a href="#" class="btn" data-dismiss="modal">Close</a>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</form>
			</div> -->

@endsection