@extends("layouts.admin.admin")
@section('title', 'Supplier Risk Level')
@section("content")
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">Supplier Risk Level</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a>
					</li>
					<li class="breadcrumb-item"><a href="#">Settings</a>
                </li>
					<li class="breadcrumb-item active">Supplier Risk Level
					</li>
				  </ol>
				</div>
			  </div>
        </div>
        <div class="content-body"><!-- Sales stats -->
		 @if(session('success1'))
					<div class="alert alert-success fade in alert-dismissible show">                
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						 <span aria-hidden="true" style="font-size:20px">×</span>
						</button>
						{{ session('success1') }}
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
				<section id="basic-form-layouts">
					<div class="row match-height">
					   <div class="col-md-10 col-12">
							<div class="card">
								
								<div class="card-content collapse show">
									<div class="card-body">

									<table id="exported_data" class="table table-striped table-bordered">
											<thead>
											   <tr>
												<th>ID</th>
												<th>Name</th>
												<th class="notexport">Actions</th>    
											   </tr>
											</thead>
											<tbody>
												@if(isset($risk_level) && !empty($risk_level) && count($risk_level) > 0)
													@foreach($risk_level as $eachitem)
												<tr>
													<td>{{$eachitem['id']}}</td>
													
													<td>
														<div id="label_field_div_{{$eachitem['id']}}">
															{{$eachitem['name']}}
														</div>
													

														<div style="display:none;" id="text_field_div_{{$eachitem['id']}}">
															<input class="form-control" id="name_{{$eachitem['id']}}" type="text" name="name" value="{{$eachitem['name']}}"><br>
															<input value="Save" type="button" class="save_btn btn btn-info" onclick="updateByID('SupplierRiskLevel',{{$eachitem['id']}})">
														</div>

													</td>

													<td><a onclick="editFunc({{$eachitem['id']}})" href="javascript:void(0)">Edit</a> | <a  onclick="deleteFunc('SupplierRiskLevel',{{$eachitem['id']}})" href="javascript:void(0)">Delete</a></td>
												</tr>
													@endforeach
												@endif
												
												
											</tfoot>
										</table>

									
									
									   {{-- error --}}
										@if(\Session::has('error'))
											<div id="error" class="text-danger text-center">
												{!! \Session::get('error') !!}
											</div>
										@endif
										@if(\Session::has('success'))
											<div id="error" class="text-success text-center">
												{!! \Session::get('success') !!}
											</div>
										@endif
										<br>
										<form id="PYForm" class="form" method="POST" action="{{ url('admin/submitSupplierRiskLevelApi') }}" novalidate>
											@csrf
										@csrf
											<div class="form-body input_fields_wrap">
												<div class="row">
													   <div class="col-md-8 col-sm-12 col-12 mb-2">
														   <div><input type="text" class="form-control required" placeholder="Add new Risk Level" name="name[1]"  ></div>
													   </div>
													   <div class="col-md-4 col-sm-12 col-12 mb-2">
														  <button type="button" class="add_field_button btn btn-warning">Add More</button>
													   </div>
												</div>											
												
												
						
											</div>

											<div class="form-actions text-left">
												<button id="submitForm" type="submit" class="btn btn-info">
													<i class="fa fa-check-square-o"></i> Save
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
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
   
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="row main"><div class="col-md-8 col-sm-12 col-12 mb-2"><input type="text" class="form-control required" placeholder="Add new Risk Level" name="name['+x+']" /></div> <div class="col-md-4 col-sm-12 col-12 mb-2"><a href="#" class="remove_field">Remove</a></div></div>'); //add input box
			
			$('.required').each(function() {
				$(this).rules("add", 
					{
						required: true,
						messages: {
							required: "Name is required",
						}
					});
			});
			
        }
    });
   //https://stackoverflow.com/questions/31603667/adding-removing-input-fields-using-jquery
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); 
		$(this).parent().parent('.main').remove(); x--;
    });


	
	$("#PYForm").validate({
		required: true,
		messages: {
			required: "Name is required",
		}
	});
});
</script>
@endsection