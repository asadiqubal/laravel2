@extends('layouts.supplier.supplier')
@section('title', 'RFQ Details')
@section("content")

   

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">RFQ Details</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('supplier/dashboard')}}">Home</a>
					</li>
					<li class="breadcrumb-item"><a href="{{url('supplier/rfq-list')}}">Manage RFQ's</a>
                </li>
					<li class="breadcrumb-item active">RFQ Details
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
					<div class="card-body card-dashboard" id="print_div">
						<?php
							
						$items = explode(",",$item_list[0]['rfq_items']);
							
							$getItemDetails = App\Helpers\CommonHelper::getItemDetails($items[0]);
						 
						 
						?>
						<?php
						
							$getUserDetails = App\Helpers\CommonHelper::getUserDetails($details['buyer_id']);
							
							
							
							
						?>
						<h4><b>Buyer : </b>{{$getUserDetails['name']}}</h4>
						<h4><b>RFQ ID : </b>{{$details['rfq_id']}}</h4>
						<h4><b>Deadline : </b>{{$details['rfq_response_dead_line']}}</h4>
						<h4><b>Receiving Date  :</b> {{date('Y-m-d',strtotime($details['created_at']))}}</h4>
						<?php 
							if(isset($items[0]) && !empty($items[0])){ 
							$quotes = App\Helpers\CommonHelper::getQuotevaluedeatails($items[0],$item_list[0]['id']);
							if(isset($quotes) && !empty($quotes)){
						?>
							<h4><b>Date of Submission  :</b> {{date('Y-m-d',strtotime($quotes['updated_at']))}}</h4>
						<?php
							}
							}else{
						?>
							
						<?php
							}
						?>
						<br>
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
						<table class="table table-striped table-bordered">
							 <thead>
                               <tr>
								
								<th>Item</th>
								<th>Unit</th>
								<th>Quantity</th>
								<th>Product Group</th>
								<th>Delivery Date</th>
								<th>Document</th>
								<th>Quote/Unit</th>
                               </tr>
                            </thead>
                            <tbody>
							<?php
								$items = explode(",",$item_list[0]['rfq_items']);
							?>
							@if(count($items) > 0)
								<form id="addShipMethodForm" class="form-horizontal form-simple" method="POST" action="" novalidate>
									@foreach($items as $eachitem)
								
										<tr>
											
								@csrf
										<?php
											$getItemDetails = App\Helpers\CommonHelper::getItemDetails($eachitem);
											$quotes = App\Helpers\CommonHelper::getQuotevalue($eachitem,$item_list[0]['id']);
										?>
											<td>{{$getItemDetails[0]->item_number}}</td>
											<td>{{$getItemDetails[0]->code}}</td>
											<td>{{$getItemDetails[0]->quantity}}</td>
											<td>{{$getItemDetails[0]->group_code}}</td>
											<td>{{$getItemDetails[0]->delivery_date}}</td>
											<td>
											 <?php
												$docs = App\Helpers\CommonHelper::getRfqItemDoc($eachitem);
												?>
												<?php 
																if(isset($docs) && !empty($docs)){ 
																	foreach($docs as $eachdoc){
																?><a  download href="{{asset('public/buyer/document/')}}/<?php	echo $eachdoc['document']; ?>">Download</a> | 

																
															<?php	}
																}
															else{ 
																	
																} 
															?>
											</td>
											<td>
												<?php 
													if(isset($quotes) && !empty($quotes)){ 
														echo $quotes;
													}else{
												?>
											
														<input type="text" name="quote[]" value="<?php if(isset($quotes) && !empty($quotes)){ echo $quotes; } ?>" <?php if(isset($quotes) && !empty($quotes)){ echo "readonly";; } ?>>
														<input type="hidden" name="rfq_items[]" value="{{$eachitem}}">
														<input type="hidden" name="rfq_item_send_id[]" value="{{$item_list[0]['id']}}">
														<input type="hidden" name="rfq_id[]" value="{{$details['id']}}">
														
														
												<?php
													}
												?>
												
												
												
											</td>
											
											
											
										</tr>
								
									@endforeach
									<?php 
										/* echo "<pre>";
										print_r($getItemDetails); */
										if(isset($quotes) && !empty($quotes)){ 
									?>
										<tr>
											<td colspan="7">
												<button onclick="printDiv('print_div')" type="button" class="btn btn-info round btn-min-width">
													Print
												</button>
											</td>
										</tr>
									<?php
										}else{
									?>
										<tr>
											<td colspan="7">
													<button type="submit" class="btn btn-info round btn-min-width">
													Submit
												</button>
										<!--	<button type="button" class="btn btn-info round btn-min-width">
													Print
												</button>-->
											</td>
										</tr>
									<?php
										}
									?>
										
								</form>
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

 
 
 <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      
	  
    </div>

  </div>
</div>

 
 
 
 
 
 
 
 <script>
	function printDiv(e){
		var n=document.getElementById(e).innerHTML;
		var o=document.body.innerHTML;
		document.body.innerHTML=n;
		window.print();
		document.body.innerHTML=o
	}
	
	
 </script>
 
 @endsection
 
 @section('footer-scripts')
	
 <script>
	
	
	$('#addShipMethodpopupForm').on('submit', function(e) {
		e.preventDefault(); 
		    $_token = "{{ csrf_token() }}";

		$.ajax({
			 headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
			type: "POST",
			url: "{{ url('supplier/submititemQuoteFormApi') }}",
			data: $(this).serialize(),
			 datatype: 'html',
			success: function(msg) {
			//alert(msg.html);
			if(msg.html == 1){
				window.location.reload(true);


			}else{
				$('#myModal').modal('show');
				$('.modal-body').html(msg.html);
			}
			
			}
		});
	});
	$('#addShipMethodForm').on('submit', function(e) {
		e.preventDefault(); 
		    $_token = "{{ csrf_token() }}";

		$.ajax({
			 headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
			type: "POST",
			url: "{{ url('supplier/submititemQuoteFormApi') }}",
			data: $(this).serialize(),
			 datatype: 'html',
			success: function(msg) {
			//alert(msg.html);
			if(msg.html == 1){
			    	alert("Quote submitted successfully");
				window.location.reload(true);


			}else{
				$('#myModal').modal('show');
				$('.modal-body').html(msg.html);
			}
			
			}
		});
	});
	
	$(document).on('click','.want_to_revise', function(e) {
		e.preventDefault(); 
		   var rfq_item_send_id = $("input[name='rfq_item_send_id[]']").val();
		   var rfq_id = $("input[name='rfq_id[]']").val();
		   var token = $('input[name=_token]').val();
			
		   
		   
		$.ajax({
			headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
			type: "POST",
			url: "{{ url('supplier/submititemQuoteFormForReviseApi') }}",
			data: { rfq_item_send_id:rfq_item_send_id,_token:token,rfq_id:rfq_id }, 
			success: function(msg) {
				if(msg ==1){
					$('#myModal').modal('hide');
				}else{
					
				}
			
			
			}
		});
	});

 </script>
 
 @endsection
 
 