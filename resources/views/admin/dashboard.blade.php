@extends('admin_layout')
@section('content')
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Dashboard</a></li>
			</ul>			
				<div class="row-fluid">	

				<a class="quick-button metro yellow span2">
					<i class="icon-group"></i>
					<p>Users</p>
					<span class="badge">{{$count_all = DB::table('report_ad')->count()}}</span>
				</a>
				<a class="quick-button metro green span2">
					<i class="icon-group"></i>
					<p>Users Active</p>
					<span class="badge">{{$count_active = DB::table('report_ad')->where('status',1)->count()}}</span>
				</a>
				<a class="quick-button metro red span2">
					<i class="icon-group"></i>
					<p>Users Unactive</p>
					<span class="badge">{{$count_unactive = DB::table('report_ad')->where('status',0)->count()}}</span>
				</a>
				<div class="clearfix"></div>
								
			</div><!--/row-->
		<br>
			<div class="row-fluid">
				<div class="box black span4" onTablet="span6" onDesktop="span4">
					<div class="box-header">
						<h2><i class="halflings-icon white user"></i><span class="break"></span>Expired User</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<ul class="dashboard-list metro">
							
								@if( $end_date < date('Y-m-d'))
									
									<p style="color:black">No Expired user</p>
									
								@else
									@foreach( $live_account as $live)
										<li class="red">
											<strong>Name:</strong> {{$live->name}}<br>
											<strong>EndDate:</strong>{{$live->end_date}}<br>
											<strong>Status:</strong> Do the Report    
											{{$auto_unactive = DB::table('report_ad')->where('end_date','<',date('Y-m-d'))->update(['status'=>0])}}         
										</li>
										 
									@endforeach
								@endif
						

						</ul>
					</div>
				</div><!--/span-->
			
			</div>
			
		
@endsection