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
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Datas</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="ha8lflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form name="add_name" id="add_name" action="{{ url('/postdata')}}" method="post"  >  
						{{ csrf_field() }}
							<div class="table-responsive">  
								<table id="dynamic_field">  
									<tr>
									<th>Date</th>
									<th>View</th>
									<th>Interested View</th>
									<th>Dealer</th>
									</tr>
									
									<tr>  
										<input class="hidden" name="data_created_at" value="<?php echo Date('Y-m-d h:i:s');?>">
										<!-- <td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td>   -->
										<td class="center"><input type="date" name="date"></td>
										<td class="center"><input type="text" name="view"></td>
										<td class="center"><input type="text" name="interest_view"></td>	
										<td class="center"> 
											<select id="selectError3" name="report_id">
												<option>Select Dealer !</option>
									 			<?php
			                           				 $all_dealer = DB::table('report_ad')
			                                		// ->where('publication_status',1)
			                                		->get();
			                            			foreach($all_dealer as $v_dealer){ ?>
			                              		<option value="{{$v_dealer->report_id}}">{{$v_dealer->name}}</li>
			                        			<?php } ?>
								  			</select></td>
										</tr>	
								 
								</table>  
								<!-- <button type="button" name="add" id="add" class="btn btn-success">Add More</button> -->
								<input type="submit" class="btn btn-primary" name="submit" id="submit" class="btn btn-info" value="Submit" />  
							</div>  
						</form> 
						<script>  
							// $(document).ready(function(){  
							// 	var i=1;  
							// 	$('#add').click(function(){  
							// 		i++;  
							// 		$('#dynamic_field').append('<tr id="row'+i+'"><td class="center"><input type="text" name="date[]"></td><td class="center"><input type="text" name="view[]"></td><td class="center"><input type="text" name="interested[]"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
							// 	});  
							// 	$(document).on('click', '.btn_remove', function(){  
							// 		var button_id = $(this).attr("id");   
							// 		$('#row'+button_id+'').remove();  
							// 	});  
								// $('#submit').click(function(){            
								// 	$.ajax({  
								// 			url:postURL,  
								// 			method:"POST",  
								// 			data:$('#add_name').serialize(),  
								// 			type:'json',
								// 			success:function(data)  
								// 			{  
								// 				if(data.error){
								// 					printErrorMsg(data.error);
								// 				}else{
								// 					i=1;
								// 					$('.dynamic-added').remove();
								// 					$('#add_name')[0].reset();
								// 					$(".print-success-msg").find("ul").html('');
								// 					$(".print-success-msg").css('display','block');
								// 					$(".print-error-msg").css('display','none');
								// 					$(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
								// 					// alert(data);  
								// 					// $('#add_name')[0].reset();  
								// 				}
											
								// 			}  
								// 	});  
								// });  
								// function printErrorMsg (msg) {
								// 	$(".print-error-msg").find("ul").html('');
								// 	$(".print-error-msg").css('display','block');
								// 	$(".print-success-msg").css('display','none');
								// 	$.each( msg, function( key, value ) {
								// 		$(".print-error-msg").find("ul").append('<li>'+value+'</li>');
								// 	});
								// }
							});  
						</script> 
						</div>
						<div class="box-content">
						<form>
							<table class="table table-striped table-bordered bootstrap-datatable datatable">
							<thead>
								<tr>
									
									<th>Date</th>
									<th>Dealer</th>
									<th>View</th>
									<th>Interested View</th>
									<th>Actions</th>
								</tr>
							</thead> 
							@foreach( $all_addmore_info as $v_addmore)
							<tbody>
								<tr>
									<td class="center">{{ $v_addmore->date }}</td>
									<td class="center">{{ $v_addmore->name}}</td>
									<td class="center">{{ $v_addmore->view }}</td>
									<td class="center">{{ $v_addmore->interest_view }}</td>
									<td class="center">
											<a class="btn btn-danger" href="{{ URL::to('/delete_data/'.$v_addmore->data_id)}}">
												<i class="halflings-icon white trash" ></i>  
											</a>
											<a class="btn btn-primary" href="{{URL::to('/edit_data/'.$v_addmore->data_id)}}" >
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