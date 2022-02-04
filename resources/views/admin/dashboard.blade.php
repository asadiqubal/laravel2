@extends("layouts.admin.admin")
@section('title', 'Dashboard')
@section("content")


   

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">Dashboard</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a>
					</li>
					<li class="breadcrumb-item active">Dashboard
					</li>
				  </ol>
				</div>
			  </div>
        </div>
        <div class="content-body"><!-- Sales stats -->
		
		    <div class="row">
					<div class="col-xl-4 col-lg-6 col-12">
						<div class="card bg-gradient-directional-warning">
							<div class="card-content">
								<div class="card-body">
									<a href="{{url('admin/company-list')}}" ><div class="media d-flex">
										<div class="media-body text-white text-left">
											<h3 class="text-white font-large-1">{{$company_count}}</h3>
											<span>Companies</span>
										</div>
										<div class="align-self-center">
											<i class="icon-rocket text-white font-large-2 float-right"></i>
										</div>
									</div> </a>
								</div> 
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-lg-6 col-12">
						<div class="card bg-gradient-directional-success">
							<div class="card-content">
								<div class="card-body">
									<a href="{{url('admin/company-user-list')}}" ><div class="media d-flex">
										<div class="media-body text-white text-left">
											<h3 class="text-white font-large-1">{{$user_count}}</h3>
											<span>Past Due RFQ’s</span>
										</div>
										<div class="align-self-center">
											<i class="icon-user text-white font-large-2 float-right"></i>
										</div>
									</div>  </a>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xl-4 col-lg-6 col-12">
						<div class="card bg-gradient-directional-danger">
							<div class="card-content">
								<div class="card-body">
									<a href="#" ><div class="media d-flex">
										<div class="media-body text-white text-left">
											<h3 class="text-white font-large-1">0</h3>
											<span>Unique RFQ's Generated</span>
										</div>
										<div class="align-self-center">
											<i class="icon-pie-chart text-white font-large-2 float-right"></i>
										</div>
									</div> </a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-lg-6 col-12">
						<div class="card bg-gradient-directional-success">
							<div class="card-content">
								<div class="card-body">
									<a href="#" ><div class="media d-flex">
										<div class="media-body text-white text-left">
											<h3 class="text-white font-large-1">0</h3>
											<span>Open RFQ’s</span>
										</div>
										<div class="align-self-center">
											<i class="icon-pie-chart text-white font-large-2 float-right"></i>
										</div>
									</div> </a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-lg-6 col-12">
						<div class="card bg-gradient-directional-info">
							<div class="card-content">
								<div class="card-body">
									<a href="#" ><div class="media d-flex">
										<div class="media-body text-white text-left">
											<h3 class="text-white font-large-1">0</h3>
											<span>In Process</span>
										</div>
										<div class="align-self-center">
											<i class="icon-pie-chart text-white font-large-2 float-right"></i>
										</div>
									</div> </a>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				
<!--<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-sm-12 border-right-blue-grey border-right-lighten-5">
                            <div class="pb-1">
                                <div class="clearfix mb-1">
                                    <i class="icon-star font-large-1 blue-grey float-left mt-1"></i>
                                    <span class="font-large-2 text-bold-300 info float-right">5,879</span>
                                </div>
                                <div class="clearfix">
                                    <span class="text-muted">Products</span>
                                    <span class="info float-right"><i class="ft-arrow-up info"></i> 16.89%</span>
                                </div>
                            </div>
                            <div class="progress mb-0" style="height: 7px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-12 border-right-blue-grey border-right-lighten-5">
                            <div class="pb-1">
                                <div class="clearfix mb-1">
                                    <i class="icon-user font-large-1 blue-grey float-left mt-1"></i>
                                    <span class="font-large-2 text-bold-300 danger float-right">423</span>
                                </div>
                                <div class="clearfix">
                                    <span class="text-muted">Orders</span>
                                    <span class="danger float-right"><i class="ft-arrow-up danger"></i> 5.14%</span>
                                </div>
                            </div>
                            <div class="progress mb-0" style="height: 7px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-12 border-right-blue-grey border-right-lighten-5">
                            <div class="pb-1">
                                <div class="clearfix mb-1">
                                    <i class="icon-shuffle font-large-1 blue-grey float-left mt-1"></i>
                                    <span class="font-large-2 text-bold-300 success float-right">61%</span>
                                </div>
                                <div class="clearfix">
                                    <span class="text-muted">Conversion</span>
                                    <span class="success float-right"><i class="ft-arrow-down success"></i> 2.24%</span>
                                </div>
                            </div>
                            <div class="progress mb-0" style="height: 7px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-12">
                            <div class="pb-1">
                                <div class="clearfix mb-1">
                                    <i class="icon-wallet font-large-1 blue-grey float-left mt-1"></i>
                                    <span class="font-large-2 text-bold-300 warning float-right">$6,87M</span>
                                </div>
                                <div class="clearfix">
                                    <span class="text-muted">Profit</span>
                                    <span class="warning float-right"><i class="ft-arrow-up warning"></i> 43.84%</span>
                                </div>
                            </div>
                            <div class="progress mb-0" style="height: 7px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->
<!--/ Sales stats -->





        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

   @endsection

    