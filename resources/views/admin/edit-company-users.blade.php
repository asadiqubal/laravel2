@extends("layouts.admin.admin")
@section('title', 'Edit Company User')
@section("content")

	<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">Edit Company users</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a>
					</li>
					<li class="breadcrumb-item"><a href="{{url('/admin/company-user-list')}}">Company Users</a>
                </li>
					<li class="breadcrumb-item active">Edit Company users
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
										<form id="addComUserForm" class="form-horizontal form-simple" method="POST" action="{{ url('admin/submitaddCompanyUserApi') }}" novalidate>
											@if($id)
												<input type="hidden" name="id" value="{{$id}}">
											@endif
										@csrf
											<div class="form-body">
												<div class="row">
													<div class="col-12">
														<div class="form-group">
															<label for="projectinput3">Company Name</label>
															<select id="projectinput3" name="company_name" class="form-control">
																<option value="" >Select company</option>
																@if(count($comapany_list) > 0)
																	@foreach($comapany_list as $eachitem)
																			<option {{ $userdetails['company_name'] == $eachitem['id'] ? 'selected' : '' }} value="{{$eachitem['id']}}">
																				{{$eachitem['name']}}
																			</option>
																	@endforeach
																@endif
																
															</select>
														</div>
													</div>
													<div class="col-12">
														<div class="form-group">
															<label for="projectinput4">Contact Name</label>
															<input value="{{old('name', $userdetails['name'])}}" type="text" id="projectinput4" class="form-control" name="name">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-12">
														<div class="form-group">
															<label for="projectinput5">Role</label>
															<select id="projectinput5" name="role_id" class="form-control">
															  <option value="">Select user role</option>
																<option {{ $userdetails['role_id'] == 1 ? 'selected' : '' }} value="1">Admin</option>
																<option {{ $userdetails['role_id'] == 2 ? 'selected' : '' }} value="2">Buyer</option>
															</select>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-12">
														<div class="form-group">
															<label for="projectinput6">Phone</label>
															<input value="{{old('phone', $userdetails['phone'])}}" type="text" id="projectinput6" class="form-control" name="phone">
														</div>
													</div>
													<div class="col-12">
														<div class="form-group">
															<label for="projectinput7">Email</label>
															<input value="{{old('email', $userdetails['email'])}}" type="email" id="projectinput7" class="form-control" name="email">
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
				role_id: "required",
				company_name: "required"
			}
		});
   });
   </script>
		@endsection