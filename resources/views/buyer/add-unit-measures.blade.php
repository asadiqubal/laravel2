@extends('layouts.buyer.buyer')
@section('title', 'Add Unit of Measures')
@section("content")

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">Add Unit of Measures</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('buyer/dashboard')}}">Home</a></li>
					<li class="breadcrumb-item"><a href="#">Setup</a></li>
					<li class="breadcrumb-item active">Add Unit of Measures
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
										<form id="addShipMethodForm" class="form-horizontal form-simple" method="POST" action="{{ url('buyer/submitaddUnitMeasuresFormApi') }}" novalidate>
										@csrf
											@if(isset($id) && $id)
												<input type="hidden" name="id" value="{{$id}}">
											@endif
											<div class="form-body">
												<div class="row">
													<div class="col-md-12 col-sm-12 col-12">
														<div class="form-group">
															<label for="code">Unit of Measures Code</label>
															<input value="<?php if(isset($details['code']) && !empty($details['code'])){ echo $details['code']; }else{ echo old('code'); } ?>" type="text" id="code" class="form-control" name="code">
														</div>
													</div>
													
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12 col-12">
														<div class="form-group">
															<label for="projectinput2">Description</label>
															<textarea id="projectinput2" class="form-control" name="description"><?php if(isset($details['description']) && !empty($details['description'])){ echo $details['description']; }else{ echo old('description'); } ?></textarea>
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
				code: "required",
				description: "required"
			}
		});
   });
   </script>
		@endsection