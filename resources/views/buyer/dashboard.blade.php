@extends('layouts.buyer.dashboard')
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
					<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a>
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
						<div class="card bg-gradient-directional-warning round">
							<div class="card-content">
								<div class="card-body">
									<a href="{{url('/buyer/rfq-list')}}" ><div class="media d-flex">
										<div class="media-body text-white text-left">
											<h3 class="text-white font-large-1">{{$todayrfq}}</h3>
											<span>RFQ's Due Today</span>
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
						<div class="card bg-gradient-directional-success round">
							<div class="card-content">
								<div class="card-body">
									<a href="{{url('/')}}/buyer/rfq-list?_token=wRZkKzpBc5ecAmztr7Pscmsxmhcscg1x4jhvWTFR&status=3&submit=Search" ><div class="media d-flex">
										<div class="media-body text-white text-left">
											<h3 class="text-white font-large-1">{{$rfqsdue}}</h3>
											<span>Past Due RFQ’s</span>
										</div>
										<div class="align-self-center">
											<i class="icon-docs text-white font-large-2 float-right"></i>
										</div>
									</div>  </a>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xl-4 col-lg-6 col-12">
						<div class="card bg-gradient-directional-danger round">
							<div class="card-content">
								<div class="card-body">
									<a href="{{url('/')}}/buyer/rfq-list?_token=wRZkKzpBc5ecAmztr7Pscmsxmhcscg1x4jhvWTFR&status=1&submit=Search" ><div class="media d-flex">
										<div class="media-body text-white text-left">
											<h3 class="text-white font-large-1">{{$inprocessrfqs}}</h3>
											<span>RFQ's in Process</span>
										</div>
										<div class="align-self-center"> 
											<i class="icon-speedometer text-white font-large-2 float-right"></i>
										</div>
									</div> </a>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				
				 <div class="row">
					<div class="col-xl-4 col-lg-6 col-12">
						<div class="card bg-gradient-directional-info round">
							<div class="card-content">
								<div class="card-body">
									<a href="{{url('/')}}/buyer/rfq-list?_token=wRZkKzpBc5ecAmztr7Pscmsxmhcscg1x4jhvWTFR&status=3&submit=Search" ><div class="media d-flex">
										<div class="media-body text-white text-left">
											<h3 class="text-white font-large-1">{{$watingrfqs}}</h3>
											<span>RFQ's Awaiting Response</span>
										</div>
										<div class="align-self-center">
											<i class="fa fa-reply text-white font-large-2 float-right"></i>
										</div>
									</div> </a>
								</div> 
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-lg-6 col-12">
						<div class="card bg-gradient-directional-red round">
							<div class="card-content">
								<div class="card-body">
									<a href="{{url('/')}}/buyer/rfq-list?_token=wRZkKzpBc5ecAmztr7Pscmsxmhcscg1x4jhvWTFR&status=4&submit=Search" ><div class="media d-flex">
										<div class="media-body text-white text-left">
											<h3 class="text-white font-large-1">{{$awardgrfqs}}</h3>
											<span>RFQ's Closed - Awarded</span>
										</div>
										<div class="align-self-center">
											<i class="icon-check text-white font-large-2 float-right"></i>
										</div>
									</div>  </a>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xl-4 col-lg-6 col-12">
						<div class="card bg-gradient-directional-secondary round">
							<div class="card-content">
								<div class="card-body">
									<a href="{{url('/')}}/buyer/rfq-list?_token=wRZkKzpBc5ecAmztr7Pscmsxmhcscg1x4jhvWTFR&status=5&submit=Search" ><div class="media d-flex">
										<div class="media-body text-white text-left">
											<h3 class="text-white font-large-1">{{$closerfqs}}</h3>
											<span>RFQ's Closed - Rejected</span>
										</div>
										<div class="align-self-center">
											<i class="icon-ban text-white font-large-2 float-right"></i>
										</div>
									</div> </a>
								</div>
							</div>
						</div>
					</div>
					
				</div>
<style>
.bg-gradient-directional-secondary{
background-image: linear-gradient(45deg,#0bc5ef,#54ffce);}
.bg-gradient-directional-red{    background-image: linear-gradient(45deg,#ef0b35,#FFCE54);}
</style>	


        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->


   @endsection