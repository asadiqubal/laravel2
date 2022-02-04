@extends('layouts.buyer.buyer')
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
					<li class="breadcrumb-item"><a href="{{url('buyer/dashboard')}}">Home</a>
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
							<h3>RFQ Quotes</h3>
							<?php
								/* echo "<pre>";
								print_r($rfqDetails);die; */
							?>
							<p><b>RFQ ID:</b> {{ $rfqDetails['rfq_id']}} <b> Created Date: </b>{{ date("m-d-Y",strtotime($rfqDetails['created_at']))}}  <b> Deadline:</b> {{$rfqDetails['rfq_response_dead_line']}} {{$rfqDetails['dead_line_time']}}</p>
						<div class="table-responsive">			
						 <table id="exported_data" class="table table-striped table-bordered">
							 <thead>
                               <tr>
								
								
								<th>Supplier</th>
								<th>Quote Submission Date</th> 
								<th>Status</th> 
								<th class="notexport">Actions</th>								
                               </tr>
                            </thead>
                            <tbody>
							
							 @if(count($item_list) > 0)
									@foreach($item_list as $eachitem)
										<tr>
											
											<td>{{$eachitem['company_name']}} <?php /* if($eachitem['status'] ==1){ echo "<span style='color:green'>-Awarded</span>"; }elseif($eachitem['status'] ==2){ echo "<span style='color:red'>-Rejected</span>"; } */ ?></td>
											<td>{{ date("m-d-Y",strtotime($eachitem['created_at']))}}</td>
											<td>
												<?php
													if($eachitem['status'] =='0'){
														$status = "Awaiting RFQ Response";
													}else{
														$status = "Quote Received";
													}
												?>
											{{ $status}}</td>
											<td>
												@if($eachitem['status'] =='1')
													<a href="{{url('/buyer/rfq-item-send-details')}}/{{$rfqDetails['id']}}/{{$eachitem['supplier_id']}}">View Quote</a> 
												@endif
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