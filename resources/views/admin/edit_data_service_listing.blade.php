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
						<form class="form-horizontal" action="{{ url('/update_data_service',$data_service_info->data_service_id)}}" method="post">
							{{ csrf_field() }}
                            <table class="table table-striped table-bordered bootstrap-datatable datatable">
							<thead>
								<tr>
									<th>Dealer</th>
									<th>All Listing Service</th>
									<th>Active Service</th>
                                    <th>Hot Deal</th>
									<th>Actions</th>
								</tr>
							</thead>   
							
							<tbody>
								<tr>
                                    <input class="hidden" name="updated_at" value="<?php echo Date('Y-m-d h:i:s');?>">
                                    <td class="center">
                                        {{$data_service_info->name}}
                                    </td>
									<td class="center"><input type="number" value="{{ $data_service_info->all_listing_service }}" name="all_listing_service"></td>
									<td class="center"><input type="number" value="{{ $data_service_info->active_service }}" name="active_service"></td>
									<td class="center"><input type="number" value="{{ $data_service_info->urgent_service }}" name="urgent_service"></td>
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