@extends('admin_layout')
@section('content')
	<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Edit Categories</a></li>
			</ul>
			<p class="alert alert-sucess">
				<?php
					// $message = Session::get('message');

					// if($message)
					// {
					// 	echo $message;
					// 	Session::put('message',NULL);
					// }
						
					
				?>
			</p>
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Form Ad Type Edition</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<!-- <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a> -->
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="{{ url('/update_category',$category_info->ad_type_id)}}" method="post">
							{{ csrf_field() }}
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Ad Type Name </label>
							  <div class="controls">
								<input type="text" class="span6 typeahead" name="ad_type_name" value="{{$category_info->ad_type_name}}" required="">
							  </div>
							</div>          
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Update</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
@endsection