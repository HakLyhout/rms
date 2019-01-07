@extends('layout')
@section('content')
<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li class="active">Checkout</li>
			</ul>
		</div>
	</div>
	<!-- /BREADCRUMB -->
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
										<th></th>
										<th class="text-center">Price</th>
										<th class="text-center">Quantity</th>
										<th class="text-center">Total</th>
										<th class="text-right"></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($contents as $v_contents) {?>
									<tr>
										<td class="thumb"><img src="{{URL::to($v_contents->options->image)}}" alt=""></td>
										<td class="details">
											<a href="#">{{$v_contents->name}}</a>
											<!-- <ul>
												<li><span>Size: {{$v_contents->size}}</span></li>
												<li><span>Color: {{$v_contents->color}}</span><li>
											</ul> -->
										</td>
										<td class="price text-center"><strong>{{$v_contents->price}}</strong><br><!-- <del class="font-weak"><small>$40.00</small></del> --></td>
										<td class="qty text-center">
											<form action="{{url('/update-cart')}}" method="post">
												{{ csrf_field()}}
												<input class="input" type="number" name="quantity" value="{{$v_contents->qty}}">
												<input type="hidden" name="rowId" value="{{$v_contents->rowId}}">&nbsp;	
												<input type="submit" name="submit" value="update" class="btn btn-sm btn-primary">
											</form>
										</td>
										<td class="total text-center"><strong class="primary-color">{{$v_contents->total}}</strong></td>
										<td class="text-right"><a href="{{URL::to('/delete-to-cart/'.$v_contents->rowId)}}"><button class="main-btn icon-btn"><i class="fa fa-close"></i></button></a></td>
									</tr>
								</tbody>
								<?php }?>
								<tfoot>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>SUBTOTAL</th>
										<th colspan="2" class="sub-total">{{Cart::subtotal()}}</th>
									</tr>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>SHIPING</th>
										<td colspan="2">Free Shipping</td>
									</tr>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>TOTAL</th>
										<th colspan="2" class="total">{{Cart::total()}}</th>
									</tr>
								</tfoot>
							
							</table>
						</div>

					</div>
	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-6">
					<form id="checkout-form" action={{url('/order_place')}} method="post"class=" clearfix">
						<div class="billing-details">
							{{csrf_field()}}
							<div class="section-title">
								<h3 class="title">Payment Method</h3>
							</div>
							<label class="form-group">
								<input class="ratio" type="radio" name="payment_gateway" value="handcash">Handcash
							</label>
							<label class="form-group">
								<input  class="ratio" type="radio" name="payment_gateway" value="bkash">BKash
							</label>
							<label class="form-group">
								<input class="ratio" type="radio" name="payment_gateway" value="cart">Debit Card
							</label>
							<div class="form-group pull-right">
								<input class="btn btn-primary btn-sm" type="submit" value="Pay">
							</div>
						</div>
					</form>
				</div>
			</div>	
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>

@endsection