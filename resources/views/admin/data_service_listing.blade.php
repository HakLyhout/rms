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
			<!-- <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
            </div>
            <div class="alert alert-success print-success-msg" style="display:none">
            <ul></ul> -->
				
			<div class="row-fluid">
                <a href="#" class="btn btn-success btn-setting">Import</a>
                <a href="{{URL::to('/number_car')}}" class="btn btn-danger btn-setting1">Number of Car</a>
                <a href="{{URL::to('/number_service')}}" class="btn btn-info btn-service">Number of Service</a>
			</div>
			<!-- Number of Car -->
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Number of Service</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-down"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form name="add_name" id="add_name" action="{{ url('/postservice')}}" method="post"  >  
						{{ csrf_field() }}
							<div class="table-responsive">  
								<table class="table table-bordered" id="dynamic_field">  
									<tr>
										<th>Dealer</th>
										<th>All Listing Service</th>
										<th>Active Service</th>
										<th>Hot Deal Service</th>
									</tr>
									
									<tr>  
										<input class="hidden" name="data_created_at" value="<?php echo Date('Y-m-d h:i:s');?>">
										<!-- <td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td>   -->
										<td class="center"> 
											<select id="selectError3" name="report_id">
												<option>Select Dealer !</option>
									 			<?php
			                           				 $all_dealer = DB::table('report_ad')
			                                		->where('main_type_id',2)
			                                		->get();
			                            			foreach($all_dealer as $v_dealer){ ?>
			                              		<option value="{{$v_dealer->report_id}}">{{$v_dealer->name}}</li>
			                        			<?php } ?>
								  			</select>
										</td>
										<td class="center"><input type="number" name="all_listing_service"></td>
										<td class="center"><input type="number" name="active_service"></td>
										<td class="center"><input type="number" name="urgent_service"></td>	
										</tr>	
								 
								</table>  
								<!-- <button type="button" name="add" id="add" class="btn btn-success">Add More</button> -->
								<input type="submit" class="btn btn-primary" name="submit" id="submit" class="btn btn-info" value="Submit" />  
							</div>  
						</form> 
						<form>
							<table class="table table-striped table-bordered bootstrap-datatable datatable">
							<thead>
								<tr>
                                    <th>Dealer</th>
									<th>All Listing Service</th>
									<th>Active Service</th>
									<th>Hot Deal Service</th>
                                   
								</tr>
							</thead>   
							@foreach( $all_service_info as $v_service)
							<tbody>
								<tr>
                                    <td class="center">{{ $v_service->name }}</td>
									<td class="center">{{ $v_service->all_listing_service }}</td>
									<td class="center">{{ $v_service->active_service }}</td>
                                    <td class="center">{{ $v_service->urgent_service }}</td>
									<td class="center">
											<a class="btn btn-danger" href="{{ URL::to('/delete_data_service/'.$v_service->data_service_id)}}">
												<i class="halflings-icon white trash" ></i>  
											</a>
											<a class="btn btn-primary" href="{{URL::to('/edit_data_service/'.$v_service->data_service_id)}}" >
												<i class="halflings-icon white edit" ></i>  
											</a>
									</td>
								</tr>
							</tbody>
							@endforeach
						
						</table>   
					  </form>         
					</div>
				</div><!--/span-->
			
            </div><!--/row-->
			<!--  -->
            
            <div class="modal hide fade" id="myModal">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h3>Import File</h3>
				</div>
				<form class="form-horizontal" action="{{ url('/save-import')}}" method="post">
							{{ csrf_field() }}
					<div class="modal-body">
						<div class="form-group">
						    <label for="role">Input Name:</label>
                            <input class="btn btn-info"  name="listing_import_field" type="file">
						</div>
					</div>
					<div class="modal-footer">
						<a href="#" class="btn" data-dismiss="modal">Close</a>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</form>
			</div>
           
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