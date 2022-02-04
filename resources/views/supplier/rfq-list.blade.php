@extends('layouts.supplier.supplier')
@section('title', 'RFQ List')
@section("content")

   

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">RFQ List</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('supplier/dashboard')}}">Home</a>
					</li>
					<li class="breadcrumb-item"><a href="#">Manage RFQ's</a>
                </li>
					<li class="breadcrumb-item active">RFQ List
					</li>
				  </ol>
				</div>
			  </div>
        </div>
        <div class="content-body"><!-- Sales stats -->
		
	
<!-- Excel - Cell background table -->
<section id="cell-background">
	<div class="row">
		<div class="col-12">
			<div class="card">
				
				<div class="card-content collapse show">
					<div class="card-body card-dashboard">
						
						<div class="table-responsive">			
						<table class="table table-striped table-bordered dataex-html5-background">
							 <thead>
                               <tr>
								
								<th>RFQ</th>
								<th>Buyer</th>
								<th>Created</th>  
								<th>Quote Submitted?</th>  
								<th>Rfq Status</th>  
								<th>Action</th>  
                               </tr>
                            </thead>
                            <tbody>
							
							 @if(count($item_list) > 0)
									@foreach($item_list as $eachitem)
										<tr>
										<?php
											$getUserDetails = App\Helpers\CommonHelper::getUserDetails($eachitem['buyer_id']);
							
										?>
											<td>{{$eachitem['rfq_id']}}</td>
											<td>{{$getUserDetails['name']}}</td>
											<td>{{$eachitem['created_at']}}</td>
											<?php
												
												
												if($eachitem['status'] =='1'){
													$status = "Response Submitted";
												}else{
													$status = "No";
												}
												
												
											?>
											<td>{{$status}}</td>
											<?php
												
												
												if($eachitem['rfq_status'] =='0'){
													$status = "In Progress";
												}else{
													$status = "Closed";
												}
												
												
											?>
											<td>{{$status}}</td>
											<td>
												<a href="{{url('/supplier/rfq-item-send-details')}}/{{$eachitem['rfqid']}}">View</a> 
											</td>
										</tr>
									@endforeach
								@endif
								
								
							</tbody>
							
							
						</table>	
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--/ Excel - Cell background table -->

	<!--<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
               
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                               <tr>
								<th>REF ID#</th>
								<th>Item</th>
                                <th>Quantity</th>
                                <th>Supplier</th>
								<th>Status</th>   
                                <th>Actions</th>   
                               </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>A100001</td>
                                    <td>Sugar</td>
                                    <td>100 kg</td>
									<td>ABC Supplier</td>
									<td>Submitted</td>
									<td><a href="#">Edit</a> | <a href="#">Cancel</a></td>
                                </tr>
                                <tr>
                                    <td>A100001</td>
                                    <td>Sugar</td>
                                    <td>100 kg</td>
									<td>ABC Supplier</td>
									<td>Submitted</td>
									<td><a href="#">Edit</a> | <a href="#">Cancel</a></td>
                                </tr>
                                 <tr>
                                    <td>A100001</td>
                                    <td>Sugar</td>
                                    <td>100 kg</td>
									<td>ABC Supplier</td>
									<td>Submitted</td>
									<td><a href="#">Edit</a> | <a href="#">Cancel</a></td>
                                </tr>
                                 <tr>
                                    <td>A100001</td>
                                    <td>Sugar</td>
                                    <td>100 kg</td>
									<td>ABC Supplier</td>
									<td>Submitted</td>
									<td><a href="#">Edit</a> | <a href="#">Cancel</a></td>
                                </tr>
								 <tr>
                                    <td>A100001</td>
                                    <td>Sugar</td>
                                    <td>100 kg</td>
									<td>ABC Supplier</td>
									<td>Submitted</td>
									<td><a href="#">Edit</a> | <a href="#">Cancel</a></td>
                                </tr>
                                 <tr>
                                    <td>A100001</td>
                                    <td>Sugar</td>
                                    <td>100 kg</td>
									<td>ABC Supplier</td>
									<td>Submitted</td>
									<td><a href="#">Edit</a> | <a href="#">Cancel</a></td>
                                </tr>
                                
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>-->
<!-- DOM - jQuery events table -->
	


        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

 @endsection