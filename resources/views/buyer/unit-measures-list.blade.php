@extends('layouts.buyer.buyer')
@section('title', 'Unit of Measures List')
@section("content")

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">Unit of Measures List</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('buyer/dashboard')}}">Home</a>
					</li>
					<li class="breadcrumb-item"><a href="#">Setup</a>
                </li>
					<li class="breadcrumb-item active">Unit of Measures List
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
								<th>Unit of Measure Code</th>
								<th>Description</th>
                                <th class="notexport">Actions</th>
                               </tr>
                            </thead>
                            <tbody>
							@if(count($unit_measure_list) > 0)
								@foreach($unit_measure_list as $eachitem)
                                <tr>
                                    <td>{{$eachitem['code']}}</td>
                                    <td>{{$eachitem['description']}}</td>
                                    <td><a href="{{url('/buyer/edit-unit-measures')}}/{{$eachitem['id']}}">Edit</a> | <a onclick="deleteFunccom('UnitMeasures',{{$eachitem['id']}})" href="javascript:void(0)" href="#">Delete</a></td>
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
</section>
<!-- DOM - jQuery events table -->
	


        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

@endsection