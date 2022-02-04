@extends("layouts.buyer.buyer")
@section('title', 'Add users')

@section("content")

	<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">Add users</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
				  <li class="breadcrumb-item"><a href="{{url('/buyer/dashboard')}}">Home</a>
					</li>
					<li class="breadcrumb-item"><a href="{{url('/buyer/user-list')}}">Company Users</a>
                </li>
					<li class="breadcrumb-item active">Add users
					</li>
				  </ol>
				</div>
			  </div>
        </div>
        <div class="content-body"><!-- Sales stats -->
		
				<section id="basic-form-layouts">
					<div class="row match-height">
					   <div class="col-md-6">
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
										<form id="addComUserForm" class="form-horizontal form-simple" method="POST" action="{{ url('buyer/submitaddUserApi') }}" novalidate>
									
										<input type="hidden" name="role_id" value="3">
										@if(isset($id) && $id)
												<input type="hidden" name="id" value="{{$id}}">
												
											@endif
										@csrf
											<div class="form-body">
												<div class="row">
												<!--
													<div class="col-12">
														<div class="form-group">
															<label for="company_name">Company Name</label>
															<select id="company_name" name="company_name" class="form-control">
																<option value="" >Select company</option>
																@if(count($comapany_list) > 0)
																	@foreach($comapany_list as $eachitem)
																			<option <?php if(isset($userdetails['company_name']) && $userdetails['company_name']==$eachitem['id']){ echo "selected"; }?> value="{{$eachitem['id']}}">
																				{{$eachitem['name']}}
																			</option>
																	@endforeach
																@endif
																
															</select>
														</div>
													</div>
													-->
													<div class="col-12">
														<div class="form-group">
															<label for="name">Contact Name</label>
															<input value="<?php if(isset($userdetails['name']) && !empty($userdetails['name'])){ echo $userdetails['name']; }else{ echo old('name'); } ?>" type="text" id="name" class="form-control" name="name">
														</div>
													</div>
												</div>
												<!--
												<div class="row">
													<div class="col-md-12 col-12">
														<div class="form-group">
															<label for="role_id">Role</label>
															<select id="role_id" name="role_id" class="form-control">
															  <option value="">Select user role</option>
																<option <?php if(isset($userdetails['role_id']) && $userdetails['role_id']==3){ echo "selected"; }?> value="3">Buyer User</option>
															</select>
														</div>
													</div>
												</div>
												-->
												<div class="row">
													<div class="col-12">
														<div class="form-group">
															<label for="phone">Phone</label>
															<input value="<?php if(isset($userdetails['phone']) && !empty($userdetails['phone'])){ echo $userdetails['phone']; }else{ echo old('phone'); } ?>" type="text" id="phone" class="form-control" name="phone">
														</div>
													</div>
													<div class="col-12">
														<div class="form-group">
															<label for="email">Email</label>
															<input value="<?php if(isset($userdetails['email']) && !empty($userdetails['email'])){ echo $userdetails['email']; }else{ echo old('email'); } ?>" type="email" id="email" class="form-control" name="email">
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
	
	
		
		$('#addComUserForm').validate({  // initialize the plugin on your form.
			rules: {
				// simple rule, converted to {required:true}
				name: "required",
				email: "required",
				phone: "required",
				//role_id: "required",
				//company_name: "required"
			}
		});
   });
   </script>
		@endsection