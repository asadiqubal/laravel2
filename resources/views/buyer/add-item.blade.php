@extends('layouts.buyer.buyer')
@section('title', 'Add Item')
@section("content")

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">Add Item</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('buyer/dashboard')}}">Home</a></li>
					<li class="breadcrumb-item"><a href="#">Setup</a></li>
					<li class="breadcrumb-item active">Add Item
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
									<!--	<form action="{{ route('import-items') }}" method="POST" enctype="multipart/form-data">
										@csrf
										<input type="file" name="file" class="form-control">
										<br>
										<button class="btn btn-success">Import Items</button>
									</form>-->
									
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
										<form id="addShipMethodForm" class="form-horizontal form-simple" method="POST" action="{{ url('buyer/submitaddItemFormApi') }}" novalidate>
										@csrf
										@if(isset($id) && $id)
												<input type="hidden" name="id" value="{{$id}}">
											@endif
											<div class="form-body">
												<div class="row">
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="item_number">Item Number</label>
															<input value="<?php if(isset($details['item_number']) && !empty($details['item_number'])){ echo $details['item_number']; }else{ echo old('item_number'); } ?>" type="text" id="item_number" class="form-control" name="item_number">
														</div>
													</div>
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="revision_number">Revision Number</label>
															<input value="<?php if(isset($details['revision_number']) && !empty($details['revision_number'])){ echo $details['revision_number']; }else{ echo old('revision_number'); } ?>" type="text" id="revision_number" class="form-control" name="revision_number">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-sm-12 col-12">
														<div class="form-group">
															<label for="description">Description</label>
															<textarea id="description" class="form-control" name="description"><?php if(isset($details['description']) && !empty($details['description'])){ echo $details['description']; }else{ echo old('description'); } ?></textarea>
														</div>
													</div>
													
												</div>
												<div class="row">
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="unit_measure">Unit of Measure</label>
															<select id="unit_measure" name="unit_measure" class="form-control">
																<option value="" selected="">Select Unit of Measure</option>
																<?php
																	if(isset($unit_measure_list) && !empty($unit_measure_list)){
																		foreach($unit_measure_list as $each){
																?>
																			<option <?php if(isset($details['unit_measure']) && $details['unit_measure']==$each['id']){ echo "selected"; }?> value="<?php echo $each['id']; ?>"><?php echo $each['code']; ?></option>
																<?php
																		}
																	}
																?>
															</select>
															<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal">Add New</a>

														</div>
													</div>
													<div class="col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label for="product_group">Product Group</label>
															<select id="product_group" name="product_group" class="form-control">
																<option value="" selected="">Select Product Group</option>
																<?php
																	if(isset($product_group_list) && !empty($product_group_list)){
																		foreach($product_group_list as $each){
																?>
																			<option <?php if(isset($details['product_group']) && $details['product_group']==$each['id']){ echo "selected"; }?> value="<?php echo $each['id']; ?>"><?php echo $each['group_code']; ?></option>
																<?php
																		}
																	}
																?>
															</select>
															<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal2">Add New</a>
														</div>
													</div>
												</div>
												<div class="row">
												
												   <div class="col-md-12 col-sm-12 col-12">
														<div class="form-group">
															<label for="part_number">Manufacturer Part Number</label>
															<input value="<?php if(isset($details['part_number']) && !empty($details['part_number'])){ echo $details['part_number']; }else{ echo old('part_number'); } ?>" type="text" id="part_number" class="form-control" name="part_number">
														</div>
													</div>
												</div>
												
												<div class="row">
												     <div class="col-md-12 col-sm-12 col-12">
														<div class="form-group">
															<label for="notes">Notes</label>
															<textarea id="notes" class="form-control" name="notes"><?php if(isset($details['notes']) && !empty($details['notes'])){ echo $details['notes']; }else{ echo old('notes'); } ?></textarea>
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
	
	<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
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
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
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
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


   @endsection
   
   
    @section('footer-scripts')
   <script>
   $(document).ready(function() {
	
	
		
		$('#addShipMethodForm').validate({  // initialize the plugin on your form.
			rules: {
				// simple rule, converted to {required:true}
				item_number: "required",
				revision_number: "required",
				description: "required",
				unit_measure: "required",
				product_group: "required",
				part_number: "required",
				//notes: "required"
			}
		});
   });
   </script>
		@endsection