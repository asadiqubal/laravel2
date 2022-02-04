@extends('layouts.buyer.buyer')
@section('title', 'Create RFQ Item')
@section("content")

   
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">Create RFQ Item</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('buyer/dashboard')}}">Home</a></li>
					<li class="breadcrumb-item"><a href="#">Manage RFQ's</a></li>
					<li class="breadcrumb-item active">Create RFQ Item
					</li>
				  </ol>
				</div>
			  </div>
        </div>
        <div class="content-body"><!-- Sales stats -->
		
				<section id="basic-form-layouts">
					<div class="row match-height">
					   <div class="col-md-8">
							<div class="card">
								
								<div class="card-content collapse show">
									<div class="card-body">
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
										<br>
										<form id="addShipMethodForm" class="form-horizontal form-simple" method="POST" action="{{ url('buyer/submitaddRfqItemFormApi') }}" novalidate>
										@csrf
											@if(isset($id) && $id)
												<input type="hidden" name="id" value="{{$id}}">
											@endif
											@if(isset($rfq_id) && $rfq_id)
												<input type="hidden" name="rfq_id" value="{{$rfq_id}}">
											@endif
											<?php if(isset($$details) && !empty($$details)){ $details  = $details[0]; } ?>
											<div class="form-body">
												<div class="row">
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="item_id">Item</label>
															<select id="item_id" name="item_id" class="form-control">
																<option value="" selected="">Select Item</option>
																<?php
																	if(isset($item_list) && !empty($item_list)){
																		foreach($item_list as $each){
																?>
																			<option <?php if(isset($details['item_id']) && $details['item_id']==$each['id']){ echo "selected"; }?> value="<?php echo $each['id']; ?>"><?php echo $each['item_number']; ?></option>
																<?php
																		}
																	}
																?>
															</select>
														</div>
													</div>
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="unit">Unit</label>
															<input value="<?php if(isset($details['unit']) && !empty($details['unit'])){ echo $details['unit']; }else{ echo old('unit'); } ?>" id="unit" type="text" name="unit" class="form-control">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="description">Description</label>
															<input value="<?php if(isset($details['description']) && !empty($details['description'])){ echo $details['description']; }else{ echo old('description'); } ?>" id="description" type="text" name="description" class="form-control">
														</div>
													</div>
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="product_group">Product Group</label>
															
															<select id="product_group" name="product_group" class="form-control">
																<option value="">Select Product Group</option>
																<?php
																	if(isset($product_group_list) && !empty($product_group_list)){
																		foreach($product_group_list as $each){
																?>
																			<option <?php if(isset($details['product_group']) && $details['product_group']==$each['id']){ echo "selected"; }?> value="<?php echo $each['id']; ?>"><?php echo $each['group_code']; ?></option>
																<?php
																		}
																	}
																?>
															</select>
															
														
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="quantity">Quantity</label>
															<input value="<?php if(isset($details['quantity']) && !empty($details['quantity'])){ echo $details['quantity']; }else{ echo old('quantity'); } ?>" type="number" id="quantity" class="form-control" name="quantity">
														</div>
													</div>
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="set_email_reminder">Delivery Date</label>
															<input value="<?php if(isset($details['delivery_date']) && !empty($details['delivery_date'])){ echo $details['delivery_date']; }else{ echo old('delivery_date'); } ?>" type="date" id="delivery_date" class="form-control" name="delivery_date">
														</div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="set_email_reminder">Special Instruction</label>
															<textarea id="special_instruction" class="form-control" name="special_instruction"><?php if(isset($details['special_instruction']) && !empty($details['special_instruction'])){ echo $details['special_instruction']; }else{ echo old('special_instruction'); } ?></textarea>

														</div>
													</div>
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="set_email_reminder">Attachment</label>
															<input type="file" name="document">

														</div>
													</div>
												</div>
												
											</div>

											<div class="form-actions text-right">
												<button type="submit" class="btn btn-info round btn-min-width">
													Submit
												</button>
											</div>
										</form>
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
   
   
  @section('footer-scripts')
   <script>
   $(document).ready(function() {
	
	
		
		$('#addShipMethodForm').validate({  // initialize the plugin on your form.
			rules: {
				// simple rule, converted to {required:true}
				item_id: "required",
				unit: "required",
				product_group: "required",
				quantity: "required",
				delivery_date: "required",
				description: "required"
			}
		});
   });
   </script>
		@endsection