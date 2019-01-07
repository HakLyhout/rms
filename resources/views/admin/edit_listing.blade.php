@extends('admin_layout')
@section('content')
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Add Brand</a></li>
			</ul>
			<p class="alert alert-sucess">
				<?php
					$message = Session::get('message');

					if($message)
					{
						echo $message;
						Session::put('message',NULL);
					}
						
					
				?>
			</p>
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Form Update Listing</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<!-- <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a> -->
						</div>
					</div>
					<div class="box-content"> 
						<form class="form-horizontal"  action="{{ url('/update_listing',$listing_info->report_id)}}" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
						  <fieldset>
                            <input class="hidden" name="listing_updated_at" value="<?php echo Date('Y-m-d h:i:s');?>">
							<div class="control-group">
							  <label class="control-label" for="typeahead"> Name </label>
							  <div class="controls">
								<input type="text" class="span6 typeahead" value="{{$listing_info->name}}" name="listing_name" required="">
							  </div>
							</div>
                            <div class="control-group">
							  <label class="control-label" for="typeahead">Listing Type Name </label>
							  <div class="controls">
								<input type="text" class="span6 typeahead" value="{{$listing_info->type_name}}" name="listing_type_name" required="">
							  </div>
							</div>
                            <div class="control-group">
							  <label class="control-label" for="typeahead">Start Date </label>
							  <div class="controls">
								<input type="date" class="span6 typeahead" value="{{$listing_info->start_date}}" name="listing_start_date" required="">
							  </div>
                              <label class="control-label" for="typeahead">End Date </label>
							  <div class="controls">
								<input type="date" class="span6 typeahead" value="{{$listing_info->end_date}}" name="listing_end_date" required="">
							  </div>
							</div>
							 <div class="control-group">
								<label class="control-label" for="selectError3"> Ad Type</label>
								<div class="controls">
								
								  <select id="selectError3" value="" name="listing_ad_type_id">
								
			
									<option>Select Ad Type !</option>
										<?php
											$all_ad_type = DB::table('ad_type')
											// ->where('publication_status',1)
											->get();
												foreach($all_ad_type as $v_type){?>	
													<?php if($v_type->ad_type_id == $listing_info->ad_type_id) {?>
													<option value="{{ $v_type->ad_type_id }}"  selected > {{ $v_type->ad_type_name }}</option>
														<?php }else{?>
															<option value="{{ $v_type->ad_type_id }}" > {{ $v_type->ad_type_name }}</option>
														<?php }?> 					
												<?php } ?>
								  </select>
								</div>
							  </div>
							   <div class="control-group">
								<label class="control-label" for="selectError3">Ads Status</label>
								<div class="controls">
								  <select id="selectError3" value="{{$listing_info->ad_status_name}}" name="listing_ad_status_id">
									<option>Select Ads Status !</option>
									 <?php
										$all_ad_status = DB::table('ad_status')
												// ->where('publication_status',1)
												->get();
												foreach($all_ad_status as $v_status){?>	
													<?php if($v_status->ad_status_id == $listing_info->ad_status_id) {?>
													<option value="{{ $v_status->ad_status_id }}"  selected > {{ $v_status->ad_status_name }}</option>
														<?php }else{?>
															<option value="{{ $v_status->ad_status_id }}"   > {{ $v_status->ad_status_name }}</option>
														<?php }?> 					
												<?php } ?>
								  </select>
								</div>
							  </div>
                              <div class="control-group">
								<label class="control-label" for="selectError4">Report Type</label>
								<div class="controls">
								  <select id="selectError4" value="{{$listing_info->report_type_id}}" name="listing_report_type_id">
									<option>Select Report Type !</option>
									 <?php
										$all_report_type = DB::table('report_type')
												// ->where('publication_status',1)
												->get();
												foreach($all_report_type as $v_report_type){?>	
													<?php if($v_report_type->report_type_id == $listing_info->report_type_id) {?>
													<option value="{{ $v_report_type->report_type_id }}"  selected > {{ $v_report_type->report_type_name }}</option>
														<?php }else{?>
															<option value="{{ $v_report_type->report_type_id }}"  > {{ $v_report_type->report_type_name }}</option>
														<?php }?> 					
												<?php } ?>
								  </select>
								</div>
							  </div>
                              <div class="control-group">
								<label class="control-label" for="selectError5">User Type</label>
								<div class="controls">
								  <select id="selectError5" value="{{$listing_info->main_type_name}}" name="listing_main_type_id">
									<option>Select Main Type !</option>
									 <?php
										$all_main_type = DB::table('main_type')
												// ->where('publication_status',1)
												->get();
												foreach($all_main_type as $v_main_type){?>	
													<?php if($v_main_type->main_type_id == $listing_info->main_type_id) {?>
													<option value="{{ $v_main_type->main_type_id }}"  selected > {{ $v_main_type->main_type_name }}</option>
														<?php }else{?>
															<option value="{{ $v_main_type->main_type_id }}"> {{ $v_main_type->main_type_name }}</option>
														<?php }?> 					
												<?php } ?>
								  </select>
								</div>
							  </div>
							<div class="control-group">
							  <label class="control-label" for="fileInput">File input</label>
							  <div class="controls">
								<input class="input-file uniform_on" id="listing_import_field" name="listing_import_field" type="file">
							  </div>
							</div>          
							
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Save changes</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   
					</div>
				</div><!--/span-->

			</div><!--/row-->
@endsection