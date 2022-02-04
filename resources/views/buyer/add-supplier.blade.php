@extends('layouts.buyer.buyer')
@section('title', 'Add Supplier')
@section("content")

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">Add Supplier</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('buyer/dashboard')}}">Home</a></li>
					<li class="breadcrumb-item"><a href="#">Setup</a></li>
					<li class="breadcrumb-item active">Add Supplier
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
							<!--<form action="{{ route('import-supplier') }}" method="POST" enctype="multipart/form-data">
								@csrf
								<input type="file" name="file" class="form-control">
								<br>
								<button class="btn btn-success">Import Supplier</button>
							</form>-->
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
										<form id="addShipMethodForm" class="form-horizontal form-simple" method="POST" action="{{ url('buyer/submitaddSupplierFormApi') }}" novalidate>
										@csrf
										
											@if(isset($id) && $id)
												<input type="hidden" name="id" value="{{$id}}">
											@endif
											
											<?php 
												if(isset($details['user_id']) && !empty($details['user_id'])){
											?>
												<input type="hidden" name="user_id" value="{{$details['user_id']}}">
											<?php
												} 
											?>
											
											<div class="form-body">
												<div class="row">
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="company_name">Company Name</label>
															<input value="<?php if(isset($details['company_name']) && !empty($details['company_name'])){ echo $details['company_name']; }else{ echo old('company_name'); } ?>" type="text" id="company_name" class="form-control" name="company_name">
														</div>
													</div>
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="company_contact_name">Company Contact Name</label>
															<input value="<?php if(isset($details['company_contact_name']) && !empty($details['company_contact_name'])){ echo $details['company_contact_name']; }else{ echo old('company_contact_name'); } ?>" type="text" id="company_contact_name" class="form-control" name="company_contact_name">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="email">Email</label>
															<input value="<?php if(isset($details['email']) && !empty($details['email'])){ echo $details['email']; }else{ echo old('email'); } ?>" type="email" id="email" class="form-control" name="email">
														</div>
													</div>
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="street_address">Street Address</label>
															<input value="<?php if(isset($details['street_address']) && !empty($details['street_address'])){ echo $details['street_address']; }else{ echo old('street_address'); } ?>" type="text" id="street_address" class="form-control" name="street_address">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="city">City</label>
															<input value="<?php if(isset($details['city']) && !empty($details['city'])){ echo $details['city']; }else{ echo old('city'); } ?>" type="text" id="city" class="form-control" name="city">
														</div>
													</div>
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="state">State</label>
															<select id="state" name="state" class="form-control">
															<option value="">Select State</option>
															<?php
																if(isset($stateList) && !empty($stateList)){
																	foreach($stateList as $eachstate){
															?>
																	 <option <?php if(isset($details['state']) && $details['state'] == $eachstate['id']){ echo "selected"; }elseif($eachstate['id'] == ''){  echo "selected"; } ?> value="{{$eachstate['id']}}">{{$eachstate['name']}}</option>
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
															<label for="zipcode">Postal Code</label>
															<input value="<?php if(isset($details['zipcode']) && !empty($details['zipcode'])){ echo $details['zipcode']; }else{ echo old('zipcode'); } ?>" type="text" id="zipcode" class="form-control" name="zipcode">
														</div>
													</div>
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="projectinput5">Country</label>
															<select id="country" name="country" class="form-control">
															<?php
																if(isset($countryList) && !empty($countryList)){
																	foreach($countryList as $eachcountry){
															?>
																	 <option <?php if(isset($details['country']) && $details['country'] == $eachcountry['id']){ echo "selected"; }else if($eachcountry['id'] == '231'){ echo "selected"; } ?> value="{{$eachcountry['id']}}">{{$eachcountry['name']}}</option>
															<?php
																	}
																}
															?>
															  
															</select>
														</div>
													</div>
												</div>
												
												<div class="row">
												
												   <div class="col-md-12 col-sm-12 col-12">
														<div class="form-group">
															<label for="supplier_risk_level">Supplier Risk Level</label>
															<select id="supplier_risk_level" name="supplier_risk_level" class="form-control">
																<option value="" selected="">Select Risk Level</option>
																<option <?php if(isset($details['supplier_risk_level']) && $details['supplier_risk_level']== 'High'){ echo "selected"; }?> value="High">High</option>
																<option <?php if(isset($details['supplier_risk_level']) && $details['supplier_risk_level']== 'Medium'){ echo "selected"; }?> value="Medium">Medium</option>
																<option <?php if(isset($details['supplier_risk_level']) && $details['supplier_risk_level']== 'Low'){ echo "selected"; }?> value="Low">Low</option>																
															</select>
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
				company_name: "required",
				company_contact_name: "required",
				email: {
					required: true,
					email: true
				},
				street_address: "required",
				city: "required",
				
				zipcode: "required",
				country: "required",
				supplier_risk_level: "required"
			}
		});
   });
   </script>
		@endsection