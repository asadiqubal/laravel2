@extends('layouts.buyer.buyer')
@section('title', 'Ship Location Details')
@section("content")
<style>
	label{
		font-weight:bold;
	}
</style>
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">Ship Location Details</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('buyer/dashboard')}}">Home</a></li>
					<li class="breadcrumb-item"><a href="#">Setup</a></li>
					<li class="breadcrumb-item active">Ship Location Details
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
										
											<div class="form-body">
												<div class="row">
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="projectinput3">Company Name</label>
															
															<br><?php echo $details['companyname']; ?>
														</div>
													</div>
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="projectinput4">Contact Name</label>
															<br><?php echo $details['contactname']; ?>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="st_address">Street Address</label><br>
															<?php echo $details['st_address']; ?>
														</div>
													</div>
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="city">City</label><br>
														<?php echo $details['city']; ?>
														</div>
													</div>
												</div>
												<div class="row">
												
												   <div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="state">State</label><br>
																<?php
																
																$statename = App\Helpers\CommonHelper::getStateName($details['state']);
																echo $statename; 
															?>
															
														</div>
													</div>
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="zipcode">Postal Code</label>
															<br>
														<?php echo $details['zipcode']; ?>
														</div>
													</div>
												
													
													
												</div>
												<div class="row">
												
													<div class="col-md-12 col-sm-12 col-12">
														<div class="form-group">
															<label for="projectinput5">Country</label><br>
															
															
															<?php
															
																if(isset($details['country']) && !empty($details['country'])){
																	$countryname = App\Helpers\CommonHelper::getCountryName($details['country']);
																	
															?>
																	 <?php echo $countryname; ?>
															<?php
																	
																}
															?>
															
															
														</div>
													</div>
												
													
													
												</div>
																							

												
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