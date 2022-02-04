@extends("layouts.admin.admin")
@section('title', 'Price Setup')
@section("content")
    <div class="app-content content">
      <div class="content-wrapper">
         <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">Price Setup</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a>
					</li>
					<li class="breadcrumb-item"><a href="#">Price</a>
                </li>
					<li class="breadcrumb-item active">Price Setup
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
										<form id="addComyForm" class="form-horizontal form-simple" method="POST" action="{{ url('admin/submitPriceSetupApi') }}" novalidate>
										
										@if($id)
												<input type="hidden" name="id" value="{{$id}}">
											@endif
										@csrf
											<div class="form-body">
												<div class="row">
													<div class="col-12">
														<div class="form-group">
														
															<label for="start_from">No. of Users Range Start from</label>
															<input value="{{old('start_from', $pricesetupdetails['start_from'])}}" type="text" id="start_from" class="form-control required" name="start_from">
															
															
														</div>
													</div>
													<div class="col-12">
														<div class="form-group">
															<label for="end_to">No of Users Range Ends</label>
															<input value="{{old('end_to', $pricesetupdetails['end_to'])}}" type="text" id="end_to" class="form-control" name="end_to">
														</div>
													</div>
													<div class="col-12">
														<div class="form-group">
															<label for="price">Price</label>
															<input value="{{old('price', $pricesetupdetails['price'])}}" type="text" id="price" class="form-control required" name="price">
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
				address: "required",
				payment_term: "required",
				industry: "required",
				rfq_range: "required"
			}
		});
   });
   </script>
		@endsection