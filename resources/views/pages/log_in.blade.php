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
					<form id="checkout-form" action={{url('/customer_registration')}} method="post" class="clearfix">
						<div class="billing-details">
							<p>Already a customer ? <a href="#">Login</a></p>
							{{csrf_field()}}
							<div class="section-title">
								<h3 class="title">Billing Details</h3>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="customer_name" placeholder="Name">
							</div>
							<div class="form-group">
								<input class="input" type="tel" name="mobile_number" placeholder="Telephone">
							</div>
							<div class="form-group">
								<input class="input" type="email" name="customer_email" placeholder="Email">
							</div>
							<div class="form-group">
								<input class="input" type="password" name="password" placeholder="Password">
							</div>
							<div class="form-group pull-right">
								<input class="btn btn-primary btn-sm" type="submit" value="Create Account">
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-6">
					<form id="checkout-form" action="{{url('/customer_login')}}" method="post" class="clearfix">
						{{csrf_field()}}
						<div class="billing-details">
							<p>Not Yet As Our Customer? <a href="#">Register</a></p>
							<div class="section-title">
								<h3 class="title">Billing Details</h3>
							</div>
							<div class="form-group">
								<input class="input" type="email" name="customer_email" placeholder="Email">
							</div>
							<div class="form-group">
								<input class="input" type="password" name="password" placeholder="Password">
							</div>
							<div class="form-group pull-right">
								<input class="btn btn-primary btn-sm" type="submit" value="Log In">
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