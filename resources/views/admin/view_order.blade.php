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
			<div class="row-fluid sortable">		
				<div class="box span6">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
						</div>
					</div>
					<div class="col-md-12">
						<div class="order-summary clearfix">
							<div class="section-title">
								<h3 class="title">Customer Detail</h3>
							</div>
							<table class="shopping-cart-table table">
								<thead>
									<tr>
										<th>Customer</th>
										<th class="text-center">Phone Number</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										@foreach($order_by_id as $v_order)
										@endforeach
										<td class="details">
											<a href="#">{{$v_order->customer_name}}</a>
										</td>
										<td class="price text-center">{{$v_order->mobile_number}}</td>
									</tr>
								</tbody>
							</table>
							
						</div>

					</div>
				</div><!--/span-->
				<div class="box span6">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Shipping </h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
						</div>
					</div>
					<div class="col-md-12">
						<div class="order-summary clearfix">
							<div class="section-title">
								<h3 class="title">Shipping Detail</h3>
							</div>
							<table class="shopping-cart-table table">
								<thead>
									<tr>
										<th>Username</th>
										<th class="text-center">Address</th>
									
										
									</tr>
								</thead>
								<tbody>
									<tr>
										@foreach($order_by_id as $v_order)
										@endforeach
										<td class="details">
											{{$v_order->shipping_name}}
										</td>
										<td class="price text-center">{{$v_order->shipping_address}}</td>
	
									</tr>
								</tbody>
							</table>
						
						</div>

					</div>
				</div><!--/span-->
			
			</div><!--/row-->

				
			
		
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
					<div class="col-md-12">
						<div class="order-summary clearfix">
							<div class="section-title">
								<h3 class="title">Order Review</h3>
							</div>
							<?php
								$contents = Cart::content();
							?>
							<table class="shopping-cart-table table">
								<thead>
									<tr>
										<th>Product</th>
										<th class="text-center">Price</th>
										<th class="text-center">Quantity</th>
										<th class="text-center">Total</th>
									
									</tr>
								</thead>
								<tbody>
									@foreach($order_by_id as $v_order)
									<tr>
				
										<!-- <td class="details">
											{{$v_order->order_id}}
										</td> -->
										<td class="price text-center">{{$v_order->product_name}}</td>
										<td class="price text-center">{{$v_order->product_price}}</td>
										<td class="price text-center">{{$v_order->product_sale_quantity}}</td>
										<td class="price text-center">{{$v_order->product_price*$v_order->product_sale_quantity}}</td>
									</tr>
									@endforeach
								</tbody>
								
								<tfoot>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>TOTAL</th>
										<th colspan="2" class="total">{{$v_order->order_total}}</th>
									</tr>
								</tfoot>
							
							</table>
						</div>

					</div>
				</div><!--/span-->
			
			</div><!--/row-->

@endsection