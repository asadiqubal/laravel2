@extends("layouts.admin.admin")
@section('title', 'Add RFQ Range')
@section("content")
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">RFQ Range</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a>
					</li>
					<li class="breadcrumb-item"><a href="{{url('admin/rfq-range-list')}}">RFQ Range</a>
                </li>
					<li class="breadcrumb-item active">Add
					</li>
				  </ol>
				</div>
			  </div>
        </div>
        <div class="content-body"><!-- Sales stats -->
		
				<section id="basic-form-layouts">
					<div class="row match-height">
					    <div class="col-12 text-right"><a href="{{url('admin/rfq-range-list')}}" class="btn btn-warning">Go Back to List</a></div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title" id="basic-layout-form">Add RFQ Range </h4>
									<a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
									
								</div>
								<div class="card-content collapse show">
									<div class="card-body">
										
										
										 {{-- error --}}
										@if(\Session::has('error'))
										   <div class="alert alert-danger fade in alert-dismissible show">                
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true" style="font-size:20px">×</span>
												</button>
												{{ session('error') }}
											</div>
										@endif
										@if(\Session::has('success'))
										   <div class="alert alert-success fade in alert-dismissible show">                
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true" style="font-size:20px">×</span>
												</button>
												{{ session('success') }}
											</div>
										@endif
										
										
										
										<div id="errormsg" class="text-danger text-center"></div>
										<br>
										<form class="form-horizontal form-simple" method="POST" action="{{ url('admin/submitRfqRangeApi') }}" novalidate>
											@csrf
										
											<div class="form-body">
												
												<div class="row">
													<div class="col-md-12 col-12">
														<div class="form-group">
															<label for="projectinput5">First Letter of the Sequence</label>
															<select id="projectinput5" name="sequence_letter" class="form-control">
																<option value="A" selected="" disabled="">A</option>
																<option value="B">B</option>
																<option value="C">C</option>
																<option value="D">D</option>
																<option value="E">E</option>
																<option value="F">F</option>
																<option value="G">G</option>
																<option value="H">H</option>
																<option value="i">I</option>
																<option value="J">J</option>
																<option value="K">K</option>
																<option value="L">L</option>
																<option value="M">M</option>
																<option value="N">N</option>
																<option value="O">O</option>
																<option value="P">P</option>
																<option value="Q">Q</option>
																<option value="R">R</option>
																<option value="S">S</option>
																<option value="T">T</option>
																<option value="U">U</option>
																<option value="V">V</option>
																<option value="W">W</option>
																<option value="X">X</option>
																<option value="Y">Y</option>
																<option value="Z">Z</option>
															</select>
														</div>
														
													</div>
													
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label for="projectinput3">Starts From</label>
															<input type="text" id="start_from" class="form-control" placeholder="e.g. 100001" name="start_from">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="projectinput4">Ends at</label>
															<input type="text" id="end_to" class="form-control" placeholder="e.g. 199999" name="end_to">
														</div>
													</div>
												</div>

												
											</div>

											<div class="form-actions text-right">
												<button id="submit" type="submit" class="btn btn-info">
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
 @section("footer-scripts")
 <script>
	$(document).ready(function(){
		 $('#submit').click(function() {
			var start_from = $("#start_from").val();
			var end_to = $("#end_to").val();
			
			if(start_from == ""){
				$("#errormsg").html("Please enter start number");
				return false;
			}else if(end_to == ""){
				$("#errormsg").html("Please enter end number");
				return false;
			}else{
				if(start_from > end_to){
					$("#errormsg").html("End number must be greater than the start number");
					return false;
				}
			}
			
		});
		
		
		
	});
 </script>
 
 
 @endsection