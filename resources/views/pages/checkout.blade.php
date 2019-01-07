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

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-6">
					<form id="checkout-form" action={{url('/shipping')}} method="post"class=" clearfix">
						<div class="billing-details">
							<p>Already a customer ? <a href="#">Login</a></p>
							{{csrf_field()}}
							<div class="section-title">
								<h3 class="title">Shipping Details</h3>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="shipping_name" placeholder="Shipping Name">
							</div>
							<div class="form-group">
								<input class="input" type="email" name="shipping_email" placeholder="Shipping Email">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="shipping_address" placeholder="Shipping Address">
							</div>
							<div class="form-group pull-right">
								<input class="btn btn-primary btn-sm" type="submit" value="Shipping">
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