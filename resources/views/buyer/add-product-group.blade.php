@extends('layouts.buyer.buyer')
@section('title', 'Add Product Group')
@section("content")

   
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">Add Product Group</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('buyer/dashboard')}}">Home</a></li>
					<li class="breadcrumb-item"><a href="#">Setup</a></li>
					<li class="breadcrumb-item active">Add Product Group
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
										<form id="addProductGroupForm" class="form-horizontal form-simple" method="POST" action="{{ url('buyer/submitaddProductGroupFormApi') }}" novalidate>
										@csrf
											@if(isset($id) && $id)
												<input type="hidden" name="id" value="{{$id}}">
											@endif
											<div class="form-body">
												<div class="row">
													<div class="col-md-12 col-sm-12 col-12">
														<div class="form-group">
															<label for="group_code">Product Group Code</label>
															<input type="text" value="<?php if(isset($details['group_code']) && !empty($details['group_code'])){ echo $details['group_code']; }else{ echo old('group_code'); } ?>" id="group_code" class="form-control" name="group_code">
														</div>
													</div>
													<!--<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="projectinput4"></label>
															<input type="text" id="projectinput4" class="form-control" name="phone">
														</div>
													</div>-->
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12 col-12">
														<div class="form-group">
															<label for="description">Product Group Description</label>
															<textarea id="description" name="description" class="form-control"><?php if(isset($details['description']) && !empty($details['description'])){ echo $details['description']; }else{ echo old('description'); } ?></textarea>
															
														</div>
													</div>
													
												</div>
												<div class="row">
												
												   <div class="col-md-12 col-sm-12 col-12">
														<div class="form-group">
															<label for="notes">Notes</label>
															<textarea id="notes" name="notes" class="form-control"><?php if(isset($details['notes']) && !empty($details['notes'])){ echo $details['notes']; }else{ echo old('notes'); } ?></textarea>
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
	
	
		
		$('#addProductGroupForm').validate({  // initialize the plugin on your form.
			rules: {
				// simple rule, converted to {required:true}
				group_code: "required",
				description: "required",
				
				
			}
		});
   });
   </script>
		@endsection