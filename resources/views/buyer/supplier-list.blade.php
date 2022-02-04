@extends('layouts.buyer.buyer')
@section('title', 'Supplier List')
@section("content")

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">Supplier List</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('buyer/dashboard')}}">Home</a>
					</li>
					<li class="breadcrumb-item"><a href="#">Setup</a>
                </li>
					<li class="breadcrumb-item active">Supplier List
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
					
					   <div class="table-responsive">
                       <table id="exported_data" class="table table-striped table-bordered">
                            <thead>
                               <tr>
								<th>Company Name</th>
								<th>Company Contact Name</th>
                                <th>Email</th>
                                <th>Street Address</th>	
								<th>City</th>	
								<th>State</th>	
								<th>Postal Code</th>	
								<th>Country</th>
								<th>Supplier Risk Level</th>
                               <th class="notexport">Actions</th>
                               </tr>
                            </thead>
                            <tbody>
								@if(count($supplier_list) > 0)
									@foreach($supplier_list as $eachitem)
								
									<?php
											$countryname = App\Helpers\CommonHelper::getCountryName($eachitem['country']);
											$statename = App\Helpers\CommonHelper::getStateName($eachitem['state']);
										?>
										<tr>
											<td>{{$eachitem['company_name']}}</td>
											<td>{{$eachitem['company_contact_name']}}</td>
											<td>{{$eachitem['email']}}</td>
											<td>{{$eachitem['street_address']}}</td>
											<td>{{$eachitem['city']}}</td>
											<td>{{$statename}}</td>
											<td>{{$eachitem['zipcode']}}</td>
											<td>{{$countryname}}</td>
											<td>{{$eachitem['supplier_risk_level']}}</td>
											<td><a href="{{url('/buyer/edit-supplier')}}/{{$eachitem['id']}}">Edit</a> | <a onclick="deleteFunccom('Supplier',{{$eachitem['id']}})" href="#">Delete</a></td>
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
    </div>
</section>
<!-- DOM - jQuery events table -->
	


        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->



 
   
@endsection