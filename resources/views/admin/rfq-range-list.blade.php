@extends("layouts.admin.admin")
@section('title', 'RFQ Ranges')
@section("content")
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">RFQ Range List</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a>
					</li>
					<li class="breadcrumb-item"><a href="#">RFQ Range</a>
                </li>
					<li class="breadcrumb-item active">List
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
                                    <th colspan="4">RFQ # Range</th>
                                    
                                </tr>
                                <tr>
                                    <th>Start From</th>
                                    <th>End Range</th>
                                    <th>Assigned to Company</th>
                                   <!-- <th class="notexport">Actions</th> -->
                                    
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($rfq_range_list) > 0)
                                @foreach($rfq_range_list as $eachitem)
                                <tr>
                                    <td>{{$eachitem['sequence_letter'].$eachitem['start_from']}}</td>
									<td>{{$eachitem['sequence_letter'].$eachitem['end_to']}}</td>
                                    <td>@if($eachitem['company_name']) {{$eachitem['company_name']}} @else  @endif</td>
									<!--<td><?php if($eachitem['company_name']) {  }else{ ?> <a href="#">Edit</a> | <a  onclick="#" href="javascript:void(0)">Delete</a> <?php } ?> </td>-->
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