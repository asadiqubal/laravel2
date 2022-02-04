@extends('layouts.buyer.buyer')
@section('title', 'Add Ship Location')
@section("content")

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">Add Ship Location</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('buyer/dashboard')}}">Home</a></li>
					<li class="breadcrumb-item"><a href="#">Setup</a></li>
					<li class="breadcrumb-item active">Add Ship Location
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
										<form id="addShipLocationForm" class="form-horizontal form-simple" method="POST" action="{{ url('buyer/submitaddShipLocationFormApi') }}" novalidate>
										@csrf
											@if(isset($id) && $id)
												<input type="hidden" name="id" value="{{$id}}">
											@endif
											<div class="form-body">
												<div class="row">
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="projectinput3">Company Name</label>
															<input value="<?php if(isset($details['companyname']) && !empty($details['companyname'])){ echo $details['companyname']; }else{ echo old('companyname'); } ?>" type="text" id="projectinput3" class="form-control" name="companyname">
														</div>
													</div>
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="projectinput4">Contact Name</label>
															<input value="<?php if(isset($details['contactname']) && !empty($details['contactname'])){ echo $details['contactname']; }else{ echo old('contactname'); } ?>" type="text" id="projectinput4" class="form-control" name="contactname">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="st_address">Street Address</label>
															<input value="<?php if(isset($details['st_address']) && !empty($details['st_address'])){ echo $details['st_address']; }else{ echo old('st_address'); } ?>" type="text" id="st_address" class="form-control" name="st_address">
														</div>
													</div>
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="city">City</label>
															<input value="<?php if(isset($details['city']) && !empty($details['city'])){ echo $details['city']; }else{ echo old('city'); } ?>" type="text" id="city" class="form-control" name="city">
														</div>
													</div>
												</div>
												<div class="row">
												
												   <div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="state">State</label>
															
															
															<select id="state" name="state" class="form-control">
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
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="zipcode">Postal Code</label>
															<input value="<?php if(isset($details['zipcode']) && !empty($details['zipcode'])){ echo $details['zipcode']; }else{ echo old('zipcode'); } ?>" type="text" id="zipcode" class="form-control" name="zipcode">
														</div>
													</div>
												
													
													
												</div>
												<div class="row">
												
													<div class="col-md-12 col-sm-12 col-12">
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
	
	
		
		$('#addShipLocationForm').validate({  // initialize the plugin on your form.
			rules: {
				// simple rule, converted to {required:true}
				companyname: "required",
				contactname: "required"
			}
		});
   });
   </script>
		@endsection