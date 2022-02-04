@extends('layouts.buyer.buyer')
@section('title', 'RFQ Quotes')
@section("content")

   

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">RFQ Quotes</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('buyer/dashboard')}}">Home</a>
					</li>
					<li class="breadcrumb-item"><a href="#">Manage RFQ's</a>
                </li>
					<li class="breadcrumb-item active">RFQ Quotes
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
						{{-- error --}}
										 @if(session('success'))
											<div class="alert alert-success fade in alert-dismissible show">                
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true" style="font-size:20px">×</span>
												</button>
												{{ session('success') }}
											</div>
											@endif
											@if(session('error'))
											<div class="alert alert-danger fade in alert-dismissible show">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												  <span aria-hidden="true" style="font-size:20px">×</span>
												</button>    
												{{ session('error') }}
											</div>
											@endif
						<div class="table-responsive">	
						<h3>RFQ Quotes</h3>
							<?php
							 /* 	 echo "<pre>";
								print_r($rfqDetails['id']);
								print_r($item_list[0]);die; */
							?>
							<?php
							$items = explode(",",$item_list[0]['rfq_items']);
								$getUserDetails = App\Helpers\CommonHelper::getSupplierDetails($item_list[0]['supplier_id']);
								$getQuoteDetails = App\Helpers\CommonHelper::getQuoteDetails($items[0],$item_list[0]['id']);
							?>
							
							<p><b>RFQ ID:</b> {{ $rfqDetails['rfq_id']}} <br> <b> Created Date: </b>{{ date("m-d-Y",strtotime($rfqDetails['created_at']))}} <br> <b> Deadline:</b> {{$rfqDetails['rfq_response_dead_line']}} {{$rfqDetails['dead_line_time']}}</p>	

							<p><b>Supplier Name: </b>{{$getUserDetails['company_name']}}	</p>	@if(isset($getQuoteDetails->created_at))						
							<p><b>Quote Submission Date: </b>
							{{ date("Y-m-d",strtotime($getQuoteDetails->created_at))}}
							@endif
							</p>							
						<table class="table table-striped table-bordered">
							 <thead>
                               <tr>
								
								<th>Item</th>
								
								<th>Quantity</th>
								<th>Unit</th>
								<th>Product Group</th>
								<th>Delivery Date</th>
								
								<th>Quote/Unit</th>
								<th>Action</th>
                               </tr>
                            </thead>
                            <tbody>
							<?php
								$items = explode(",",$item_list[0]['rfq_items']);
							?>
							 @if(count($items) > 0)
									@foreach($items as $eachitem)
								
										<tr>
										
										<?php
											$getItemDetails = App\Helpers\CommonHelper::getItemDetails($eachitem);
										
											$quotes = App\Helpers\CommonHelper::getQuotevalue($eachitem,$item_list[0]['id']);
											$quotesStatus = App\Helpers\CommonHelper::getQuoteStatus($eachitem,$item_list[0]['id']);
											$getQuoteDetails = App\Helpers\CommonHelper::getQuoteDetails($eachitem,$item_list[0]['id']);
											
												/* echo "<pre>";
											print_r($item_list[0]['status']); die; */
										?>
											<td>{{$getItemDetails[0]->item_number}}</td>
											<td>{{$getItemDetails[0]->code}}</td>
											<td>{{$getItemDetails[0]->quantity}}</td>
											<td>{{$getItemDetails[0]->group_code}}</td>
											<td>{{$getItemDetails[0]->delivery_date}}</td>
											
											
											<td><?php if(isset($quotes) && !empty($quotes)){ echo $quotes; } ?></td>
											
											<td>
											<?php 
												if($quotesStatus ==0){
											?>
												<a title="Award" href="{{url('buyer/status-change-quote')}}/{{$getItemDetails[0]->id}}/{{$rfqDetails['id']}}/{{$item_list[0]['supplier_id']}}/1" class="btn btn-info round">
													<i class="fa fa-check"></i>
												</a>
												<a title="Reject" href="{{url('buyer/status-change-quote')}}/{{$getItemDetails[0]->id}}/{{$rfqDetails['id']}}/{{$item_list[0]['supplier_id']}}/2" class="btn btn-danger round">
													<i class="fa fa-close"></i>
												</a>
											<?php
												}elseif($quotesStatus == 1){
													echo "Awarded";
												}else{
													echo "Rejected";
												}
											?>
											</td>
										
										</tr>
								
									@endforeach
									<?php 
									if($item_list[0]['status'] ==0){
										/*
									?>
									<tr>
										<td colspan="6">
											<div class="clearfix"></div>
											
											<div class="form-actions text-right"> <!--/-->
												<a href="{{url('buyer/status-change-quote')}}/{{$rfqDetails['id']}}/{{$item_list[0]['supplier_id']}}/1" class="btn btn-info round btn-min-width">
													Accept
												</a>
												<a href="{{url('buyer/status-change-quote')}}/{{$rfqDetails['id']}}/{{$item_list[0]['supplier_id']}}/2" class="btn btn-danger round btn-min-width">
													Reject
												</a>
											</div>
										</td>
									</tr>
									<?php
									}else{
									?>
										<tr>
											<td colspan="6">
											<div class="form-actions text-right"> 
												<?php 
													if($item_list[0]['status'] ==1){
														echo "<span style='color:green'>Awarded</span>";
													}else{
														echo "<span style='color:red'>Rejected</span>";
													}
												?>
											</div>
											</td>
										</tr>
									<?php
									*/
									} 
									
									?>
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



        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

 @endsection