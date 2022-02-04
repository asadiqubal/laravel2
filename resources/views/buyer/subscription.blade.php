@extends('layouts.buyer.dashboard')
@section('title', 'Dashboard')
@section("content")
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">My Subscription</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.html">Home</a>
					</li>
					<li class="breadcrumb-item active">My Subscription</li>
				  </ol>
				</div>
			  </div>
        </div>
        <div class="content-body"><!-- Sales stats -->
<style>
.table td{ border-top: 1px solid transparent;}
.table th{
border-top: 1px solid transparent;
    color: #054c84;
    font-weight: 400;
    font-size: 16px;
}
.user-account blockquote{
background: #eee;
    padding: 10px;
    border-left: 3px solid #ffce0b;
    line-height: 28px;
}

</style>		
		 <section>
					<div class="row">
						<div class="col-md-8 col-sm-12 col-12">
							<div class="card">
							   
								<div class="card-content collapse show">
									<div class="card-body card-dashboard">
									
									    <div class="table-responsive">
										   <table class="table">
											  <tbody>
												<tr>
												  <th scope="row">Name of plan</th>
												  <td>{{$subscription_details['name']}}</td>												  
												</tr>
												<tr>
												  <th scope="row">Number of Users</th>
												  <td>{{$subscription_details['start_from']}}-{{$subscription_details['end_to']}}</td>												 
												</tr>
												<tr>
												  <th scope="row">Price</th>
												  <td>${{$subscription_details['price']}}</td>												  
												</tr>
												<tr>
												  <th scope="row">Start Date</th>
												  <?php
												  //  echo "<pre>";
												  //  print_r($payment_logs[0]['created_at']); die;
												  ?>
												  <td>{{ date("M d,Y",strtotime($payment_logs[0]['created_at']))}}</td>												  
												</tr>
												<tr>
												  <th scope="row">Expiry Date</th>
												  <?php
												  
												  
                                                
                                                $dateString = $payment_logs[0]['created_at'];
                                                $t = strtotime($dateString);
                                                $t2 = strtotime('365 days', $t);
                                                
                                                
												  ?>
												  <td>{{ date("M d,Y",$t2)}}</td>												  
												</tr>
											  </tbody>
											</table>
										
											
										</div>
									
									
										
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-4 col-sm-12 col-12">
						    <div class="card user-account">
							    <h4 class="px-2 pt-1 text-left">My Account</h4>
									<div class="card-body">
									   
                            <blockquote class="mb-0"><strong>Username:</strong> {{Auth::user()->name}} <br/>
<strong>Email:</strong> {{Auth::user()->email}}</blockquote>
								
								   <a class="btn btn-info mt-2" href="{{ route('logout') }}"
                                       >
									<i class="ft-power"></i> {{ __('Logout Everywhere') }}
								</a>
					 
								  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
													@csrf
												</form>
												
								
										
									</div>
									
								
							</div>
						    
						</div>
						
					</div>
					
				<div class="row" id="dom">
						<div class="col-12">
							<div class="card">
							   
								<div class="card-content collapse show">
									<div class="card-body card-dashboard">
									   <h4 class="mb-2">Past Invoices</h4>
									
										<table class="table table-striped table-bordered dom-jQuery-events">
											<thead>
											   <tr>
												<th>Date</th>
												<th>Invoice No</th>
												<th>Pricing Plan</th>
												<th>Amount</th>
												<th>Status</th>   
												<th>Action</th>   
												
											   </tr>
											</thead>
											<tbody>
											    <?php
											        if(isset($payment_logs)){
											            foreach($payment_logs as $eachval){
											                $plandetail = App\Helpers\CommonHelper::getSubscriptionDetails($eachval['subscription_id']);
								                ?>
					                        	<tr>
													<td>{{date('M d,Y',strtotime($eachval['created_at']))}}</td>
													<td>35E498FAA6</td>
													<td>{{$plandetail['name']}}</td>
													<td>${{$plandetail['price']}}</td>
													<td>Paid</td>
													<td><a href="#">View</a> | <a href="#">Delete</a></td>
												</tr>
								                
								                <?php
											            }
											        }
											    ?>
											
											
											
											</tfoot>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					
</section>


        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

 

   @endsection