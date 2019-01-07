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
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Form Products</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<!-- <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a> -->
						</div>
					</div>
					<div class="box-content"> 
						<form class="form-horizontal"  action="{{ url('/save-product')}}" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Product Name </label>
							  <div class="controls">
								<input type="text" class="span6 typeahead" name="product_name" required="">
							  </div>
							</div>
							 <div class="control-group">
								<label class="control-label" for="selectError3">Product Category</label>
								<div class="controls">
								  <select id="selectError3" name="category_id">
									<option>Select Categories !</option>
									 <?php
			                            $all_published_category = DB::table('tbl_category')
			                                ->where('publication_status',1)
			                                ->get();
			                            foreach($all_published_category as $v_category){ ?>
			                              <option value="{{$v_category->id}}">{{$v_category->category_name}}</li>
			                        <?php } ?>
								  </select>
								</div>
							  </div>
							   <div class="control-group">
								<label class="control-label" for="selectError3">Product Brand</label>
								<div class="controls">
								  <select id="selectError3" name="manufacture_id">
									<option>Select Brand !</option>
									 <?php
			                            $all_published_brand = DB::table('tbl_manufacture')
			                                ->where('publication_status',1)
			                                ->get();
			                            foreach($all_published_brand as $v_brand){ ?>
			                              <option value="{{$v_brand->manufacture_id}}">{{$v_brand->manufacture_name}}</li>
			                        <?php } ?>
								  </select>
								</div>
							  </div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Short Description</label>
							  <div class="controls">
								<textarea class="cleditor" name="product_short_description" id="textarea2" rows="3"></textarea>
							  </div>
							</div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Long Description</label>
							  <div class="controls">
								<textarea class="cleditor" name="product_long_description" id="textarea2" rows="3"></textarea>
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label" for="appendedPrependedInput">Price</label>
								<div class="controls">
								  <div class="input-prepend input-append">
									<span class="add-on">$</span><input id="appendedPrependedInput" name="product_price" size="16" type="text"><span class="add-on">.00</span>
								  </div>
								</div>
							  </div>
							 <div class="control-group">
							  <label class="control-label" for="typeahead">Size </label>
							  <div class="controls">
								<input type="text" class="span6 typeahead" name="product_size" required="">
							  </div>
							</div>
							 <div class="control-group">
							  <label class="control-label" for="typeahead">Color </label>
							  <div class="controls">
								<input type="text" class="span6 typeahead" name="product_color" required="">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="fileInput">File input</label>
							  <div class="controls">
								<input class="input-file uniform_on" id="product_image" name="product_image" type="file">
							  </div>
							</div>          
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Publication Status</label>
							  <div class="controls">
								<input type="checkbox" name="publication_status" value="1">
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