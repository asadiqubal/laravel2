@extends('layouts.buyer.buyer')
@section('title', 'RFQ Item List')
@section("content")

   

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">RFQ Item List</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('buyer/dashboard')}}">Home</a>
					</li>
					<li class="breadcrumb-item"><a href="#">Manage RFQ's</a>
                </li>
					<li class="breadcrumb-item active">RFQ Item List
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
						<div class="table-responsive">	
						<a href="{{url('buyer/create-rfq-item')}}/{{$rfq_id}}" class="btn btn-info" style="float:right;">Add RFQ Item</a>						
						 <table id="exported_data" class="table table-striped table-bordered">
							 <thead>
                               <tr>
								<th>REF ID#</th>
								<th>Item</th>
								<th>Unit</th>
                                <th>Product Group</th>
                                <th class="notexport">Actions</th>   
                               </tr>
                            </thead>
                            <tbody>
							
							 @if(count($rfq_item_list) > 0)
									@foreach($rfq_item_list as $eachitem)
										<tr>
											<td>{{$eachitem['rfq_id']}}</td>
											<td>{{$eachitem['item_id']}}</td>
											<td>{{$eachitem['unit']}}</td>
											<td>{{$eachitem['product_group']}}</td>
											<td><a href="{{url('/buyer/edit-rfq-item')}}/{{$eachitem['rfq_id']}}/{{$eachitem['id']}}">Edit</a> | <a onclick="deleteFunccom('RfqItem',{{$eachitem['id']}})" href="#">Delete</a> </td>
										</tr>
									@endforeach
								@endif
								
								
							</tbody>
							<tfoot>
								<tr>
									<th>REF ID#</th>
									<th>RFQ Response Dead Line</th>
									<th>Set Email Reminder</th>
									<th>Date of Reminder</th>
								<th class="notexport">Actions</th>
								</tr>
							</tfoot>
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