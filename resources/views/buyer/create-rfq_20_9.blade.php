@extends('layouts.buyer.buyer')
@section('title', 'Create RFQ')
@section("content")

<?php
	session_start();
?>
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">Create RFQ</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('buyer/dashboard')}}">Home</a></li>
					<li class="breadcrumb-item"><a href="#">Manage RFQ's</a></li>
					<li class="breadcrumb-item active">Create RFQ
					</li>
				  </ol>
				</div>
			  </div>
        </div>
        <div class="content-body"><!-- Sales stats -->
		
				<section id="basic-form-layouts">
					<div class="row match-height">
					   <div class="col-md-12">
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
										
										<?php
										$rfq_status = "";
										if(isset($details['status']) && !empty($details['status'])){
											$rfq_status = $details['status'];
										}
										
										?>
										<div class="text-center" style="background: #ddd;padding: 1px;margin-bottom: 0px !important;margin-top: 15px;">
											<h3 style="font-weight:bold;">Step 1 - General Information</h3>
										</div>
	<br>
										<form id="addShipMethodForm" class="form-horizontal form-simple" method="POST" action="{{ url('buyer/submitaddRfqFormApi') }}" novalidate>
										@csrf
											@if(isset($id) && $id)
												<input type="hidden" name="id" value="{{$id}}">
											@endif
											<div class="form-body">
												
												<div class="row">
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="rfq_id">RFQ ID</label>
															<?php
																if(isset($id) && $id){
																?>
															<input type="text" name="rfq_id" class="form-control" value="<?php echo $details['rfq_id']; ?>" readonly>
															<?php
																}else{
															?>
															<input type="text" name="rfq_id" class="form-control" value="<?php echo $rfq_range_list['sequence_letter'].$rfq_count; ?>" readonly>
															<?php
																}
															?>
															<!--
															<select id="rfq_id" name="rfq_id" class="form-control">
																
																<?php
																if(isset($id) && $id){
																?>
																	<option selected value="<?php echo $details['rfq_id']; ?>"><?php echo $details['rfq_id']; ?></option>
																<?php
																}else{
																	if(isset($rfq_range_list) && !empty($rfq_range_list)){
																	
																?>
																	<option <?php if(isset($details['rfq_id']) && $details['rfq_id']==$rfq_range_list['id']){ echo "selected"; }?> value="<?php echo $rfq_range_list['sequence_letter'].$rfq_count; ?>"><?php echo $rfq_range_list['sequence_letter'].$rfq_count; ?></option>
																<?php
																		
																	}
																}
																?>
																
																
																
															</select>-->
														</div>
													</div>
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="payment_term">Payment term</label>
															<select id="payment_term" name="payment_term" class="form-control">
																<option value="" selected="">Select Payment Term</option>
																<?php
																	if(isset($payment_term_list) && !empty($payment_term_list)){
																		foreach($payment_term_list as $each){
																?>
																			<option <?php if(isset($details['payment_term']) && $details['payment_term']==$each['id']){ echo "selected"; }?> value="<?php echo $each['id']; ?>"><?php echo $each['name']; ?></option>
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
															<label for="ship_method">Ship Method</label>
															<select id="ship_method" name="ship_method" class="form-control">
																<option value="" selected="">Select ship method</option>
																<?php
																	if(isset($ship_method_list) && !empty($ship_method_list)){
																		foreach($ship_method_list as $each){
																?>
																			<option <?php if(isset($details['ship_method']) && $details['ship_method']==$each['id']){ echo "selected"; }?> value="<?php echo $each['id']; ?>"><?php echo $each['name']; ?></option>
																<?php
																		}
																	}
																?>
															</select>
														</div>
													</div>
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="ship_location">Ship Location</label>
															<select id="ship_location" name="ship_location" class="form-control">
																<option value="" selected="">Select ship location</option>
																<?php
																	if(isset($ship_location_list) && !empty($ship_location_list)){
																		foreach($ship_location_list as $each){
																?>
																			<option <?php if(isset($details['ship_location']) && $details['ship_location']==$each['id']){ echo "selected"; }?> value="<?php echo $each['id']; ?>"><?php echo $each['companyname']; ?></option>
																<?php
																		}
																	}
																?>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 col-sm-12 col-12 row">
														<div class="col-sm-6">
															<div class="form-group">
																<label for="rfq_response_dead_line">RFQ Response Deadline</label>
																<input value="<?php if(isset($details['rfq_response_dead_line']) && !empty($details['rfq_response_dead_line'])){ echo $details['rfq_response_dead_line']; }else{ echo old('rfq_response_dead_line'); } ?>" type="date" id="rfq_response_dead_line" class="form-control" name="rfq_response_dead_line">
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">
																<label for="rfq_response_dead_line">RFQ Response Deadline Time</label>
																<input value="<?php if(isset($details['dead_line_time']) && !empty($details['dead_line_time'])){ echo $details['dead_line_time']; }else{ echo old('dead_line_time'); } ?>" type="time" id="dead_line_time" class="form-control timepicker" name="dead_line_time">
															</div>
														</div>
													</div>
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="set_email_reminder">Set Email Reminder</label>
															<select class="form-control" id="set_email_reminder" name="set_email_reminder">
																<option value="">Select Email Reminder</option>
																<option <?php if(isset($details['set_email_reminder']) && $details['set_email_reminder']=='One hour before'){ echo "selected"; }?>  value="One hour before">One hour before</option>
																<option <?php if(isset($details['set_email_reminder']) && $details['set_email_reminder']=='One day before'){ echo "selected"; }?>  value="One day before">One day before</option>
																<option <?php if(isset($details['set_email_reminder']) && $details['set_email_reminder']=='one week before'){ echo "selected"; }?>  value="one week before">one week before</option>
																
															</select>
														</div>
													</div>
												</div>
												<!--
												<div class="row">
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="set_email_reminder">Date of Reminder</label>
															<input value="<?php if(isset($details['date_of_reminder']) && !empty($details['date_of_reminder'])){ echo $details['date_of_reminder']; }else{ echo old('date_of_reminder'); } ?>" type="date" id="date_of_reminder" class="form-control" name="date_of_reminder">
														</div>
													</div>
												</div>
												-->
											</div>

											<div class="form-actions text-right">
												<button type="submit" class="btn btn-info round btn-min-width">
													Save & Add Items
												</button>
											</div>
										</form>
										<div class="text-center" style="background: #ddd;padding: 1px;margin-bottom: 0px !important;margin-top: 15px;">
											<h3 style="font-weight:bold;">Step 2 - Add Items</h3>
										</div>
										<br>
										<?php
											//print_r($rfq_item_list); die;
										?>
									@if(isset($id) && $id)
									@if(isset($rfq_item_list) && $rfq_item_list)
									<?php
									$i =1;
									
									?>
									@foreach($rfq_item_list as $eachitem)
										
									
										<form id="addShipMethodForm" class="form-horizontal form-simple" method="POST" action="{{ url('buyer/submitaddRfqItemFormApi') }}" novalidate enctype="multipart/form-data">
										@csrf
											@if(isset($eachitem['id']) && $eachitem['id'])
												<input type="hidden" name="id" value="{{$eachitem['id']}}">
											@endif
											@if(isset($id) && $id)
												<input type="hidden" name="rfq_id" value="{{$id}}">
											@endif
											<?php if(isset($eachitem) && !empty($eachitem)){ $details  = $eachitem; } ?>
											<div class="form-body">
												<div class="row">
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="item_id_<?php echo $i; ?>">Item</label>
															<select id="item_id_<?php echo $i; ?>" name="item_id" class="item_id form-control">
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
															<label for="unit_<?php echo $i; ?>">Unit</label>
															<select id="unit_<?php echo $i; ?>" name="unit" class="form-control" readonly="readonly">
																<option value="">Select Unit</option>
																<?php
																	if(isset($unit_list) && !empty($unit_list)){
																		foreach($unit_list as $each){
																?>
																			<option <?php if(isset($details['unit']) && $details['unit']==$each['id']){ echo "selected"; }?> value="<?php echo $each['id']; ?>"><?php echo $each['code']; ?></option>
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
															<label for="description_<?php echo $i; ?>">Description</label>
															<input value="<?php if(isset($details['description']) && !empty($details['description'])){ echo $details['description']; }else{ echo old('description'); } ?>" id="description_<?php echo $i; ?>" type="text" id="description" name="description" class="form-control">
														</div>
													</div>
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="product_group_<?php echo $i; ?>">Product Group</label>
															
															<select id="product_group_<?php echo $i; ?>" name="product_group" class="form-control" readonly="readonly">
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
															<label for="quantity_<?php echo $i; ?>">Quantity</label>
															<input value="<?php if(isset($details['quantity']) && !empty($details['quantity'])){ echo $details['quantity']; }else{ echo old('quantity'); } ?>" type="number" id="quantity_<?php echo $i; ?>" class="form-control" name="quantity">
														</div>
													</div>
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="delivery_date_<?php echo $i; ?>">Delivery Date</label>
															<input value="<?php if(isset($details['delivery_date']) && !empty($details['delivery_date'])){ echo $details['delivery_date']; }else{ echo old('delivery_date'); } ?>" type="date" id="delivery_date_<?php echo $i; ?>" class="form-control" name="delivery_date">
														</div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="special_instruction_<?php echo $i; ?>">Special Instruction</label>
															<textarea id="special_instruction_<?php echo $i; ?>" class="form-control" name="special_instruction"><?php if(isset($details['special_instruction']) && !empty($details['special_instruction'])){ echo $details['special_instruction']; }else{ echo old('special_instruction'); } ?></textarea>

														</div>
													</div>
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="set_email_reminder">Attachment</label>
															<input type="file" name="document">
															<?php 
																if(isset($details['document']) && !empty($details['document'])){ 
																?><a  download href="<?php	echo $details['document']; ?>">Download</a> 
															<?php	}else{ 
																	
																} 
															?>

														</div>
													</div>
												</div>
												
											</div>

											<div class="form-actions text-right">
											
												<?php
														if(isset($id) && !empty($id)){ 
													?>
															<button type="submit" class="btn btn-info round btn-min-width">
																Save
															</button>
													<?php
														}else{
													?>
															<button type="submit" class="btn btn-info round btn-min-width">
																Save
															</button>
													<?php
														}
													?>
													
													
												
											</div>
										</form>
										
										<?php
										$i++;
										?>
											@endforeach	
											
										@endif	
										
									@endif
									<?php
									
										if($rfq_status == 1){
									?>
									
									<?php
									if(session('save_exit')){
										?>
										@section('footer-scripts')
										<script>
											$(document).ready(function(){
												$(".save_and_exit_div").show();
					
												var scrollDiv = document.getElementById("save_and_exit_div").offsetTop;
												window.scrollTo({ top: scrollDiv, behavior: 'smooth'});
												$('#Send_RFQ_Suppliers').removeAttr('disabled');
											});
										</script>
									@endsection
									<?php
										}else{
											
											
									?>
									<div class="text-center">
										<a href="javascript:void(0)" class="btn btn-primary add_more_rfq_item">Add More RFQ Item</a>
									</div>
									<div class="appended_form_div">
										
										
									</div>
									 
									<?php
										}
									?>
									<!--
									<div class="form-actions text-right">
										<?php
											if(isset($id) && !empty($id)){ 
										?>
												<button type="button" class="btn btn-info round btn-min-width save_exit">
													Save and Exit
												</button>
										<?php
											}else{
										?>
												<button disabled type="button" class="btn btn-info round btn-min-width save_exit">
													Save and Exit
												</button>
										<?php
											}
										?>
										
										
									</div>-->
										
									<div class="save_and_exit_div" id="save_and_exit_div">
										<div class="text-center" style="background: #ddd;padding: 1px;margin-bottom: 0px !important;margin-top: 15px;">
											<h3 style="font-weight:bold;">Step 3 - Send to Suppliers</h3>
										</div>
										<br>
										
										<form id="addShipMethodForm" class="form-horizontal form-simple" method="POST" action="{{ url('buyer/sendRfqSupplierFormApi') }}" novalidate>
											@csrf
											@if(isset($id) && $id)
												<input type="hidden" name="rfq_id" value="{{$id}}">
											@endif
											@if(isset($rfq_item_list) && $rfq_item_list)
								
												@foreach($rfq_item_list as $eachitem)
													<input type="hidden" name="rfq_items[]" value="{{$eachitem['id']}}">
												@endforeach	
											
											@endif	
											
											
											<div class="col-md-6 col-sm-12 col-12">
												<div class="form-group">
													<label for="supplier">Suppliers</label>
													
													<select id="supplier" name="supplier[]" class="form-control" multiple>
													
														<?php
															if(isset($supplier_list) && !empty($supplier_list)){
																foreach($supplier_list as $each){
														?>
																	<option value="<?php echo $each['id']; ?>"><?php echo $each['company_name']; ?></option>
														<?php
																}
															}
														?>
													</select>
													
												
												</div>
											</div>
											<div class="form-actions text-right">
											
												<button disabled id="Send_RFQ_Suppliers" type="submit" class="btn btn-info round btn-min-width">
													Send RFQ to Suppliers
												</button>
											</div>
										</form>
										
									</div>
										&nbsp;&nbsp;
										
									<?php
										}else if($rfq_status == 2){
									?>
											<div class="text-center" style="background: #ddd;padding: 13px;margin-bottom: 20px;margin-top: 15px;">
												<h3 style="color:red;">Already Sent to Supplier(s)</h3>
											</div>
									<?php
										}
									?>
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
				rfq_id: "required",
				payment_term: "required",
				ship_method: "required"
			}
		});
		

		
		
		
		
		
   });
   </script>
   <?php
		//if(isset($id) && !empty($id)){
			if(isset($id) && !empty($id)){ $id = $id; }else{ $id = 0; }
	?>
		<script>
			$(document).ready(function(){
				 $.ajaxSetup({
					headers:
						{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
				});
				
				$(document).on("click",".save_exit",function(){
					$(".save_and_exit_div").show();
					
					var scrollDiv = document.getElementById("save_and_exit_div").offsetTop;
					window.scrollTo({ top: scrollDiv, behavior: 'smooth'});
					$('#Send_RFQ_Suppliers').removeAttr('disabled');

				});
					
				
				$(document).on("change","#item_id",function(){
					
					
					
					var id = $(this).val();
					
					
					var datastr = "id=" + id;
					$.ajax({
						type:'POST',
						headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
						 url: "<?php echo url('/'); ?>/buyer/get_unit_and_product_group_of_item/" + id,
						//url: "{{ url('buyer/add-rfq-item-form')}}",
						 date:'',

						cache: false,
						success: function (data){
							var returnedData = JSON.parse(data);
							var unit_measure = returnedData.unit_measure;
							var product_group = returnedData.product_group;
							var description = returnedData.description;
							$('#unit').val(unit_measure);
							$('#product_group').val(product_group);
							$('#description').val(description);
$('select[readonly="readonly"] option:not(:selected)').attr('disabled',true);
							 /* $(".appended_form_div").html("");
							 $(".appended_form_div").html(data); */
						},
						error: function(data){
							console.log(data);
						}
					});
				});
				add_more_rfq_item_fun();
				//$('.add_more_rfq_item').trigger('click');
				if($('.add_more_rfq_item').length > 0){
					
				
					
					
					$(document).on("click",".add_more_rfq_item",function(){
						
						
						$(".add_more_rfq_item").remove();
						var id = "<?php echo $id; ?>";
						var datastr = "id=" + id;
						$.ajax({
							type:'POST',
							headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
							 url: "<?php echo url('/'); ?>/buyer/add-rfq-item-form/" + id,
							//url: "{{ url('buyer/add-rfq-item-form')}}",
							 date:'',
							cache: false,
							success: function (data){
								$(".appended_form_div").html(data);
							},
							error: function(data){
								console.log(data);
							}
						});
						
						
					});
				}
				
				
				$('select[readonly="readonly"] option:not(:selected)').attr('disabled',true);
			});
			
			function add_more_rfq_item_fun(){
				$(".add_more_rfq_item").remove();
					var id = "<?php echo $id; ?>";
					var datastr = "id=" + id;
					$.ajax({
						type:'POST',
						headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
						 url: "<?php echo url('/'); ?>/buyer/add-rfq-item-form/" + id,
						//url: "{{ url('buyer/add-rfq-item-form')}}",
						 date:'',
						cache: false,
						success: function (data){
							$(".appended_form_div").html(data);
						},
						error: function(data){
							console.log(data);
						}
					});
			}
		</script>
	<?php
		//}
   ?>
		@endsection