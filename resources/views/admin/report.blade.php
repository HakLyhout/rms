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
				<a href="#" class="btn btn-info btn-setting">Add More</a>
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
								  <th>Report Type ID</th>
								  <th>Report Type Name</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  @foreach( $all_report_info as $v_reports)
						  <tbody>
							<tr>
								<td>{{ $v_reports->report_type_id }}</td>
								<td class="center">{{ $v_reports->report_type_name}}</td>
								<td class="center">
										<a class="btn btn-info" href="{{ URL::to('/edit_reports/'.$v_reports->report_type_id)}}">
											<i class="halflings-icon white edit "></i> 
										</a>
										<a class="btn btn-danger" id="delete" href="{{ URL::to('/delete_reports/'.$v_reports->report_type_id)}}">
											<i class="halflings-icon white trash"></i> 
										</a>
									
								</td>
							</tr>
						  </tbody>
						  @endforeach
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<div class="modal hide fade" id="myModal">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h3>Add Report Type</h3>
				</div>
				<form class="form-horizontal" action="{{ url('/save-reports')}}" method="post">
							{{ csrf_field() }}
					<div class="modal-body">
						<div class="form-group">
						    <label for="role">Report Type Name:</label>
						    <input type="text" name="report_type_name" class="form-control" id="report_type" required>
						</div>
					</div>
					<div class="modal-footer">
						<a href="#" class="btn" data-dismiss="modal">Close</a>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</form>
			</div>

@endsection