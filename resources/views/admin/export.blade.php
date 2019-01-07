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
						<form name="add_name" id="add_name" action="{{ url('/postfilter')}}" method="get"  >  
						{{ csrf_field() }}
							<div class="table-responsive">  
								<table class="table table-bordered" id="dynamic_field">  
									<tr>
										<th>Dealer</th>
                                        
									</tr>
									
									<tr>  
										<!-- <td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td>   -->
										<td class="center"> 
											<select id="selectError3" data-rel="chosen" name="report_id">
												<option>Select Dealer !</option>
									 			<?php
			                           				 $all_dealer = DB::table('report_ad')
			                                		// ->where('main_type_id',1)
			                                		->get();
			                            			foreach($all_dealer as $v_dealer){ ?>
			                              		<option value="{{$v_dealer->report_id}}"><a href="{{URL::to('/postfilter/.$v_dealer->report_id')}}">{{$v_dealer->name}}</a></option>
			                        			<?php } ?>
								  			</select>
										</td>
                                        <td><a href="#" type="submit" class="btn btn-success">Filter<td>
                                    </tr>	
								 
								</table>
							</div>  
						</form>
					</div>
				</div><!--/span-->
			
            </div><!--/row-->
@endsection