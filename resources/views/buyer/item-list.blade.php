@extends('layouts.buyer.buyer')
@section('title', 'Item List')
@section("content")

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">Item List</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('buyer/dashboard')}}">Home</a>
					</li>
					<li class="breadcrumb-item"><a href="#">Setup</a>
                </li>
					<li class="breadcrumb-item active">Item List
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
								<th>Item Number</th>
								<th>Revision Number</th>
								<th>Description</th>
								<th>Unit of Measure</th>
                                <th>Product Group</th>
                                <th>Manufacturer Part Number</th>
								<th>Notes</th>
                                <th class="notexport">Actions</th>   
                               </tr>
                            </thead>
                            <tbody>
                                @if(count($item_list) > 0)
									@foreach($item_list as $eachitem)
										<tr>
											<td>{{$eachitem['item_number']}}</td>
											<td>{{$eachitem['revision_number']}}</td>
											<td>{{$eachitem['description']}}</td>
											<td>{{$eachitem['code']}}</td>
											<td>{{$eachitem['group_code']}}</td>
											<td>{{$eachitem['part_number']}}</td>
											<td>{{$eachitem['notes']}}</td>
											<td><a href="{{url('/buyer/edit-item')}}/{{$eachitem['id']}}">Edit</a> | <a onclick="deleteFunccom('Item',{{$eachitem['id']}})" href="#">Delete</a></td>
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