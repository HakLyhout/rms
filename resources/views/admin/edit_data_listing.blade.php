@extends('admin_layout')
@section('content')
	<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Data Edition</a></li>
			</ul>
			<div class="row-fluid">
				<div class="box span12">
					<div class="box-header" >
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Data Edition</h2>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="{{ url('/update_data',$data_info->data_id)}}" method="post">
							{{ csrf_field() }}
                            <table class="table table-striped table-bordered bootstrap-datatable datatable">
							<thead>
								<tr>
									
									<th>Date</th>
									<th>View</th>
									<th>Interested View</th>
									<th>Actions</th>
								</tr>
							</thead>   
							
							<tbody>
								<tr>
									<input class="hidden" name="updated_at" value="<?php echo Date('Y-m-d h:i:s');?>">
									<td class="center"><input type="date" value="{{ $data_info->date }}" name="date"></td>
									<td class="center"><input type="text" value="{{ $data_info->view }}" name="view"></td>
									<td class="center"><input type="text" value="{{ $data_info->interest_view }}" name="interest_view"></td>
									<td class="center">
											<button type="submit" class="btn btn-success" >
												Submit  
											</button>
									</td>
								</tr>
							</tbody>
						</table>   
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
@endsection