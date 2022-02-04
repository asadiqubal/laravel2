@extends('layouts.buyer.buyer')
@section('title', $heading)
@section("content")

<style>
	.form-control{
		float: left;
    width: 227px;
	}
</style>

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">{{$heading}}</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('buyer/dashboard')}}">Home</a>
					</li>
					<li class="breadcrumb-item"><a href="#">Manage RFQ's</a>
                </li>
					<li class="breadcrumb-item active">{{$heading}}
					</li>
				  </ol>
				</div>
			  </div>
        </div>
        <div class="content-body"><!-- Sales stats -->
		
	
<!-- Excel - Cell background table -->
<section id="cell-background">
	<div class="row">
		<div class="col-12">
			<div class="card">
				
				<div class="card-content collapse show">
					<div class="card-body card-dashboard">
					  {{-- error --}}
										 @if(session('success1'))
											<div class="alert alert-success fade in alert-dismissible show">                
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true" style="font-size:20px">×</span>
												</button>
												{{ session('success1') }}
											</div>
											@endif
											@if(session('error1'))
											<div class="alert alert-danger fade in alert-dismissible show">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												  <span aria-hidden="true" style="font-size:20px">×</span>
												</button>    
												{{ session('error1') }}
											</div>
											@endif
						<div class="row mb-4" > 
									<?php
										if(!isset($is_draft)){
									?>
										 
								      
										<div class="col-md-8">
										    
											<div class="d-inline-block custom-control custom-radio mr-1 pt-1">
												<input <?php if(isset($_GET['status']) && !empty($_GET['status'])){ echo "checked"; }?> type="radio" class="custom-control-input" name="colorRadio" id="radio1" >
												<label class="custom-control-label" for="radio1">Search By Status</label>
											</div>
											
											<div class="d-inline-block custom-control custom-radio mr-1 pt-1">
												<input <?php if(isset($_GET['supplier']) && !empty($_GET['supplier'])){ echo "checked"; }?> type="radio" class="custom-control-input" name="colorRadio" id="radio2" >
												<label class="custom-control-label" for="radio2">Search By Supplier</label>
											  </div>
											
											<div class="d-inline-block custom-control custom-radio mr-1 pt-1">
												<input <?php if(isset($_GET['item']) && !empty($_GET['item'])){ echo "checked"; }?> type="radio" class="custom-control-input" name="colorRadio" id="radio3">
												<label class="custom-control-label" for="radio3">Search By Item</label>
											  </div>
											
											<div class="d-inline-block custom-control custom-radio mr-1 pt-1">
												<input <?php if(isset($_GET['duedate']) && !empty($_GET['duedate'])){ echo "checked"; }?> type="radio" class="custom-control-input" name="colorRadio" id="radio4">
												<label class="custom-control-label" for="radio4">Search By Due Date</label>
											 </div>  
											  
										</div>
										
										<div class="col-md-4">
											<form <?php if(isset($_GET['status']) && !empty($_GET['status'])){ }else{ if(isset($_GET['duedate']) && !empty($_GET['duedate'])){ ?> style="display:none;" <?php } } ?> id="statussearch" class="form-horizontal form-simple" method="GET" action="{{ url('buyer/rfq-list') }}">
											@csrf
												<select id="projectinput1" name="status" class="form-control">
														<option value="">Serach By Status</option>
														<option value="0">In Progress</option>
														<option value="1">Closed</option>
														<option value="3">Past Due</option>
														<?php
															/*
														?>
														@if($rfq_status)
															@foreach($rfq_status as $each)
																<option <?php if(isset($_GET['status']) && $_GET['status'] ==$each['id']){ echo "selected"; }?> value="{{$each['id']}}">{{$each['name']}}</option>
															@endforeach
														@endif
														<?php
														*/
														?>
													
												  </select>
												  <input class="btn btn-info"  type="submit" name="submit" value="Search">
											</form>
											
											<form <?php if(isset($_GET['supplier']) && !empty($_GET['supplier'])){ }else{ ?> style="display:none;" <?php } ?> id="suppliersearch" class="form-horizontal form-simple" method="GET" action="{{ url('buyer/rfq-list') }}">
											@csrf
												 <select id="projectinput1" name="supplier" class="form-control">
														<option value="">Serach By Supplier</option>
														@if(count($supplier_list) > 0)
															@foreach($supplier_list as $each)
																<option <?php if(isset($_GET['supplier']) && $_GET['supplier'] ==$each['id']){ echo "selected"; }?> value="{{$each['id']}}">{{$each['company_name']}}</option>
															@endforeach
														@endif
												  </select>
												  <input class="btn btn-info"  type="submit" name="submit" value="Search">
											</form>
											<form <?php if(isset($_GET['item']) && !empty($_GET['item'])){ }else{ ?> style="display:none;" <?php } ?> id="itemsearch" class="form-horizontal form-simple" method="GET" action="{{ url('buyer/rfq-list') }}">
											@csrf
												 <select id="projectinput1" name="item" class="form-control">
														<option value="">Serach By Item</option>
														@if(count($item_list) > 0)
															@foreach($item_list as $each)
																<option <?php if(isset($_GET['item']) && $_GET['item'] ==$each['id']){ echo "selected"; }?> value="{{$each['id']}}">{{$each['item_number']}}</option>
															@endforeach
														@endif
												  </select>
												  <input class="btn btn-info"  type="submit" name="submit" value="Search">
											</form>
											<form <?php if(isset($_GET['duedate']) && !empty($_GET['duedate'])){ }else{ ?> style="display:none;" <?php } ?> id="duedatesearch" class="form-horizontal form-simple" method="GET" action="{{ url('buyer/rfq-list') }}">
											@csrf
												 <input value="<?php if(isset($_GET['duedate']) && !empty($_GET['duedate'])){ echo $_GET['duedate']; } ?>" type="date" name="duedate" class="form-control">
												  <input class="btn btn-info" type="submit" name="submit" value="Search">
											</form>
											
										</div>
										
								<?php
								$export = 0;
								}else{
									?>
									<style>
										.buttons-excel{ display:none;}
									</style>
									<?php
									$export = 1;
								}
								?>		
						</div>
									
						<div class="table-responsive">			
						 <table id="exported_data" class="table table-striped table-bordered">
							 <thead>
                               <tr>
								
								<th>REF ID#</th>
								<th>Created Date </th>
								<th>Deadline Date</th>
								<th>Deadline Time </th>
								<?php
									if(!isset($is_draft)){
								?>
                                <th>Status</th>
								<?php
									}
								?>
                               <th class="notexport">Actions</th>   
                               </tr>
                            </thead>
                            <tbody>
							
							 @if(count($rfq_list) > 0)
									@foreach($rfq_list as $eachitem)
										<tr>
											
											<td>{{$eachitem['rfq_id']}}</td>
											<td>{{ date("m-d-Y",strtotime($eachitem['created_at'])) }}</td>
											<td>{{$eachitem['rfq_response_dead_line']}}</td>
											<td>{{$eachitem['dead_line_time']}}</td>
											<?php
												
												
												//$status = App\Helpers\CommonHelper::getRfqStatusTitle($eachitem['status']);
												
												if($eachitem['status'] == 0){
													$status = "In Progress";
												}elseif($eachitem['status'] ==1){
													$status = "Closed";
												}else{
													$status = "Past Due";
												}
											?>
											<?php
												if(!isset($is_draft)){
											?>
											<td>{{$status}}</td>
											<?php
												}
											?>
											<td>
												
												<a href="{{url('/buyer/edit-rfq')}}/{{$eachitem['id']}}">Edit</a>
												<!--<a onclick="deleteFunccom('Rfq',{{$eachitem['id']}})" href="#">Delete</a> | 
												<a href="{{url('/buyer/rfq-item-list')}}/{{$eachitem['id']}}">Manage RFQ Item</a> 
												-->
												| <a href="{{url('/buyer/view-rfq')}}/{{$eachitem['id']}}">View</a> |
												 <a href="{{url('/buyer/rfq-send-details')}}/{{$eachitem['id']}}">View Quotes</a>
												<?php
													if(isset($eachitem['status']) && $eachitem['status'] ==0 ){
												?>|
												
												<a href="{{url('/buyer/cancel-send-rfq')}}/{{$eachitem['id']}}">Cancel</a>
												|<a onclick="deleteFunc('Rfq',{{$eachitem['id']}})" href="javascript:void(0)">Delete</a>
												<?php
													}elseif($eachitem['status'] ==0){
												?>
													|<a onclick="deleteFunc('Rfq',{{$eachitem['id']}})" href="javascript:void(0)">Delete</a>
												<?php
													}
												?>
											</td>
										</tr>
									@endforeach
								@endif
								
								
							</tbody>
							
							
						</table>	
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--/ Excel - Cell background table -->

	<!--<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
               
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                               <tr>
								<th>REF ID#</th>
								<th>Item</th>
                                <th>Quantity</th>
                                <th>Supplier</th>
								<th>Status</th>   
                                <th>Actions</th>   
                               </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>A100001</td>
                                    <td>Sugar</td>
                                    <td>100 kg</td>
									<td>ABC Supplier</td>
									<td>Submitted</td>
									<td><a href="#">Edit</a> | <a href="#">Cancel</a></td>
                                </tr>
                                <tr>
                                    <td>A100001</td>
                                    <td>Sugar</td>
                                    <td>100 kg</td>
									<td>ABC Supplier</td>
									<td>Submitted</td>
									<td><a href="#">Edit</a> | <a href="#">Cancel</a></td>
                                </tr>
                                 <tr>
                                    <td>A100001</td>
                                    <td>Sugar</td>
                                    <td>100 kg</td>
									<td>ABC Supplier</td>
									<td>Submitted</td>
									<td><a href="#">Edit</a> | <a href="#">Cancel</a></td>
                                </tr>
                                 <tr>
                                    <td>A100001</td>
                                    <td>Sugar</td>
                                    <td>100 kg</td>
									<td>ABC Supplier</td>
									<td>Submitted</td>
									<td><a href="#">Edit</a> | <a href="#">Cancel</a></td>
                                </tr>
								 <tr>
                                    <td>A100001</td>
                                    <td>Sugar</td>
                                    <td>100 kg</td>
									<td>ABC Supplier</td>
									<td>Submitted</td>
									<td><a href="#">Edit</a> | <a href="#">Cancel</a></td>
                                </tr>
                                 <tr>
                                    <td>A100001</td>
                                    <td>Sugar</td>
                                    <td>100 kg</td>
									<td>ABC Supplier</td>
									<td>Submitted</td>
									<td><a href="#">Edit</a> | <a href="#">Cancel</a></td>
                                </tr>
                                
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>-->
<!-- DOM - jQuery events table -->
	


        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

 @endsection
 
 
 
   @section('footer-scripts')
   <script>
   $(document).ready(function() {
	
	$(document).on('click','#radio1',function(){
		$('#statussearch').show();
		$('#suppliersearch').hide();
		$('#itemsearch').hide();
		$('#duedatesearch').hide();
	});
	$(document).on('click','#radio2',function(){
		$('#statussearch').hide();
		$('#suppliersearch').show();
		$('#itemsearch').hide();
		$('#duedatesearch').hide();
	});
	$(document).on('click','#radio3',function(){
		$('#statussearch').hide();
		$('#suppliersearch').hide();
		$('#itemsearch').show();
		$('#duedatesearch').hide();
	});
	$(document).on('click','#radio4',function(){
		$('#statussearch').hide();
		$('#suppliersearch').hide();
		$('#itemsearch').hide();
		$('#duedatesearch').show();
	});
	
   });
   </script>
		@endsection