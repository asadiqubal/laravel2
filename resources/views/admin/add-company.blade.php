@extends("layouts.admin.admin")
@section('title', 'Add Company')
@section("content")
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">Add Company</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a>
					</li>
					<li class="breadcrumb-item"><a href="#">Company</a>
                </li>
					<li class="breadcrumb-item active">Add Company
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
										<br>
										<form id="addComyForm" class="form-horizontal form-simple" method="POST" action="{{ url('admin/submitaddCompanyApi') }}" novalidate>
											@csrf
											<div class="form-body">
												<div class="row">
													<div class="col-6">
														<div class="form-group">
															<label for="name">Company Name</label>
															<input value="{{old('name')}}" type="text" id="name" class="form-control required" name="name">
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label for="projectinput4">Address</label>
															<input type="text" id="projectinput4" class="form-control" name="address">
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label for="city">City</label>
															<input type="text" id="city" class="form-control" name="city">
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label for="State">State</label>
															<select id="state" name="state" class="form-control">
															<?php
																if(isset($stateList) && !empty($stateList)){
																	foreach($stateList as $eachstate){
															?>
																	 <option <?php if($eachstate['id'] == ''){  echo "selected"; } ?> value="{{$eachstate['id']}}">{{$eachstate['name']}}</option>
															<?php
																	}
																}
															?>
															</select>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label for="country">Country</label>
															
															<select id="country" name="country" class="form-control">
															<?php
																if(isset($countryList) && !empty($countryList)){
																	foreach($countryList as $eachcountry){
															?>
																	 <option <?php if($eachcountry['id'] == '231'){ echo "selected"; } ?> value="{{$eachcountry['id']}}">{{$eachcountry['name']}}</option>
															<?php
																	}
																}
															?>
															  
															</select>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label for="zip_code">Zip Code</label>
															<input type="text" id="zip_code" class="form-control" name="zip_code">
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label for="projectinputw">Website</label>
															<input type="text" id="projectinputw" class="form-control" name="website">
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label for="projectinputc">Contact Name</label>
															<input type="text" id="projectinputc" class="form-control required" name="contact_name">
														</div>
													</div>
													
													<div class="col-6">
														<div class="form-group">
															<label for="city">Email</label>
															<input type="text" id="email" class="form-control" name="email">
														</div>
													</div>
													
													<div class="col-6">
														<div class="form-group">
															<label for="city">Phone</label>
															<input type="text" id="phone" class="form-control" name="phone">
														</div>
													</div>
													
												</div>
												<div class="row">
													
													
												</div>
												<div class="row">
													<!--<div class="col-md-6 col-6">
														<div class="form-group">
															<label for="payment_term">Payments Terms</label>
															<select class="form-control" id="payment_term" name="payment_term">
																<option value="">Select Payment Terms</option>
																@if(count($payment_terms) > 0)
																	@foreach($payment_terms as $eachitem)
																			<option value="{{$eachitem['id']}}">
																				{{$eachitem['name']}}
																			</option>
																	@endforeach
																@endif
																	
															</select>
															
														</div>
														
													</div>-->
													
													<input type="hidden" value="" id="payment_term" class="form-control required" name="payment_term">
													<div class="col-md-6 col-6 price_append_div">
														<div class="form-group">
															<label for="no_of_users">No of Users</label>
															<select id="no_of_users" name="no_of_users" class="form-control">
																<option value="">Select No of users</option>
																@if(count($pricesetp_list) > 0)
																	@foreach($pricesetp_list as $eachitem)
																			<option value="{{$eachitem['id']}}">
																				@if($eachitem['end_to'] == 0)
																					> {{$eachitem['start_from']}}
																				@else
																					{{$eachitem['start_from']}} - {{$eachitem['end_to']}}
																				@endif
																			</option>
																	@endforeach
																@endif
															</select>
														</div>
													</div>
												
													<div class="col-6">
														<div class="form-group">
															<label for="projectinput5">Industry</label>
															<select id="projectinput5" name="industry" class="form-control">
																<option value="">Select Industry</option>
																@if(count($industry_list) > 0)
																	@foreach($industry_list as $eachitem)
																			<option value="{{$eachitem['id']}}">
																				{{$eachitem['name']}}
																			</option>
																	@endforeach
																@endif
															</select>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label for="projectinput6">RFQ Range</label>
															<select id="projectinput6" name="rfq_range" class="form-control">
																<option value="">Select RFQ Range</option>
																@if(count($rfqrange_list) > 0)
																	@foreach($rfqrange_list as $eachitem)
																			<option value="{{$eachitem['id']}}">
																				{{$eachitem['sequence_letter'].$eachitem['start_from'].'-'. $eachitem['sequence_letter'].$eachitem['end_to']}}
																			</option>
																	@endforeach
																@endif
															
															</select>
														</div>
													</div>
												</div>

												
											</div>

											<div class="form-actions text-right">
												<button type="submit" class="btn btn-info">
													<i class="fa fa-check-square-o"></i> Submit
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
	
	
		
		$('#addComyForm').validate({  // initialize the plugin on your form.
			rules: {
				// simple rule, converted to {required:true}
				name: "required",
				email: "required",
				contact_name: "required",
				no_of_users: "required",
				phone: "required",
				address: "required",
			
				industry: "required",
				rfq_range: "required"
			}
		});
		
		$(document).on("change","#no_of_users",function(){
			var selectedCountry = $(this).children("option:selected").val();
		
			$.ajax({
				type: "get",	
				url: "{{url('/')}}/admin/getPriceForUserList/"+selectedCountry,                                     
				data: '',
				cache: false,
				success: function (data){
					if($('#appenddiscount').length > 0){
						$('#appenddiscount').remove();
					}
					if($('#appendprice').length > 0){
						$('#appendprice').remove();
					}
					$('.price_append_div').after(data);										
				}
			})	    

		});
   });
   </script>
		@endsection