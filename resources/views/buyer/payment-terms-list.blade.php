@extends('layouts.buyer.buyer')
@section('title', 'Payment Terms List')
@section("content")

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">Payment Terms List</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('buyer/dashboard')}}">Home</a></li>
					<li class="breadcrumb-item"><a href="#">Setup</a></li>
					<li class="breadcrumb-item active">Payment Terms List
					</li>
				  </ol>
				</div>
			  </div>
        </div>
        <div class="content-body"><!-- Sales stats -->
		
				<section id="dom">
					<div class="row">
						<div class="col-12">
							<div class="card">
							   
								<div class="card-content collapse show">
									<div class="card-body card-dashboard">
									
										 <table id="exported_data" class="table table-striped table-bordered">
											<thead>
											   <tr>
												<th>Payment Code</th>
												<th>Description</th>
												 <th class="notexport">Actions</th> 
											   </tr>
											</thead>
											<tbody>
											
												@if(count($payment_term_list) > 0)
													@foreach($payment_term_list as $eachitem)
													<tr>
														<td>{{$eachitem['name']}}</td>
														<td>{{$eachitem['description']}}</td>
														<td> <a href="{{url('/buyer/edit-payment-terms')}}/{{$eachitem['id']}}">Edit</a> | <a onclick="deleteFunccom('PaymentTerms',{{$eachitem['id']}})" href="javascript:void(0)">Delete</a></td>
													</tr>
													@endforeach
												@endif
												
												
											</tfoot>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<!--<div class="row">
					<div class="col-12">
							<div class="card">
							   
								<div class="card-content">
									<div class="card-body card-dashboard">
									  
									  <form class="form">
											<div class="form-body input_fields_wrap">
												<div class="row mb-2">
													   <div class="col-md-8 col-sm-12 col-12">
														   <div><input type="text" class="form-control" placeholder="Add New Product Group" name="mytext[]"></div>
													   </div>
													   <div class="col-md-4 col-sm-12 col-12">
														  <button class="add_field_button btn btn-outline-warning btn-min-width">Add More</button>
													   </div>
												</div>	
											</div>

											<div class="form-actions text-left pb-0">
												<button type="submit" class="btn btn-info round btn-min-width">
													Save
												</button>
											</div>
										</form>
								</div>
								</div>
							</div>
						</div>
					</div>	-->
</section>
<!-- DOM - jQuery events table -->
	


        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

  @endsection
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
            $(wrapper).append('<div class="row main"><div class="col-md-8 col-sm-12 col-12 mb-2"><input type="text" class="form-control" placeholder="Add New Product Group" name="mytext[]"/></div> <div class="col-md-4 col-sm-12 col-12 mb-2"><a href="#" class="remove_field">Remove</a></div></div>'); //add input box
			
			
			
        }
    });
   
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); 
		$(this).parent().parent('.main').remove(); x--;
    })
});
</script>

