@extends("layouts.buyer.buyerpayment")
@section('title', 'Make Payment')
@section("content")

<style>
#pmpro_levels_table .pricing_box{
  transition: all 0.6s cubic-bezier(.165,.84,.44,1);
}
#pmpro_levels_table .pricing_box:hover {
    -webkit-box-shadow: 0 0 0 3px #052b49;
    -moz-box-shadow: 0 0 0 3px #052b49;
    box-shadow: 0 0 0 3px #052b49;
	-webkit-transform: translate3d(0,-6px,0);
    transform: translate3d(0,-6px,0);
	transition: all 0.6s cubic-bezier(.165,.84,.44,1);
	
}
.pricing_selected{
    -webkit-box-shadow: 0 0 0 3px rgb(92 117 136 / 56%);
    -moz-box-shadow: 0 0 0 3px rgb(92 117 136 / 56%);
    box-shadow: 0 0 0 3px rgb(92 117 136 / 56%);
}
</style>
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">Make Payment</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('buyer/dashboard')}}">Home</a>
					</li>
					<li class="breadcrumb-item active">Make Payment
					</li>
				  </ol>
				</div>
			  </div>
        </div>
        <div class="content-body"><!-- Sales stats -->
		<section id="pmpro_levels_table">
    
    <div class="row mt-2">
		<?php
			if(isset($userdata['discount']) && !empty($userdata['discount'])){
				$totalprice = $userdata['price']- $userdata['discount'];
			}else{
				$totalprice = $priceDetails['price'];
			}
		?>
		<div class="col-xl-4 col-md-6 col-12" style="margin:0 auto;">
			<div class="card profile-card-with-cover pricing_box pricing_selected">
				<div class="card-content card-deck text-center">
					<div class="card box-shadow">
					  <div class="card-header pb-0">
						<div class="text-center mb-2"> </div>
						<h2 class="my-0 font-weight-bold">{{$priceDetails['name']}}</h2>
					  </div>
					  <div class="card-body">
						<h1 class="pricing-card-title">$<?php echo $totalprice*12; ?> <small class="text-muted">/ year</small></h1>
						<ul class="list-unstyled mt-2 mb-2">
						  <li>
							@if($priceDetails->end_to == 0)
								> {{$priceDetails->start_from}}
							@else
								{{$priceDetails->start_from}} - {{$priceDetails->end_to}}
							@endif
						  Users</li>
						</ul>
					  </div>
					</div>
				</div>
			</div>
		</div>

    </div>
</section>


@php
    $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
@endphp
<!-- Company Overview section START -->
<section class="container-fluid inner-Page" >
    <div class="card-panel">
        <div class="media wow fadeInUp" data-wow-duration="1s"> 
            <div class="companyIcon">
            </div>
            <div class="media-body">
                
                <div class="container">
                    @if(session('success_msg'))
                    <div class="alert alert-success fade in alert-dismissible show">                
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true" style="font-size:20px">×</span>
                        </button>
                        {{ session('success_msg') }}
                    </div>
                    @endif
                    @if(session('error_msg'))
                    <div class="alert alert-danger fade in alert-dismissible show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true" style="font-size:20px">×</span>
                        </button>    
                        {{ session('error_msg') }}
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <h1>Payment</h1>
                        </div>                       
                    </div>    
                    <div class="row">                        
                        <div class="col-xs-12 col-md-6" style="background: lightgreen; border-radius: 5px; padding: 10px;">
                            <div class="panel panel-primary">                                       
                                <div class="creditCardForm">                                    
                                    <div class="payment">
                                        <form id="payment-card-info" method="post" action="{{ route('dopay.online') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group owner col-md-8">
                                                    <label for="owner">Owner</label>
                                                    <input type="hidden" class="form-control" id="no_of_users" name="no_of_users" value="{{ $priceDetails->id }}" required>
                                                    <input type="text" class="form-control" id="owner" name="owner" value="{{ old('owner') }}" required>
                                                    <span id="owner-error" class="error text-red">Please enter owner name</span>
                                                </div>
                                                <div class="form-group CVV col-md-4">
                                                    <label for="cvv">CVV</label>
                                                    <input type="number" class="form-control" id="cvv" name="cvv" value="{{ old('cvv') }}" required>
                                                    <span id="cvv-error" class="error text-red">Please enter cvv</span>
                                                </div>
                                            </div>    
                                            <div class="row">
                                                <div class="form-group col-md-12" id="card-number-field">
                                                    <label for="cardNumber">Card Number</label>
                                                    <input type="text" class="form-control" id="cardNumber" name="cardNumber" value="{{ old('cardNumber') }}" required>
                                                    <span id="card-error" class="error text-red">Please enter valid card number</span>
                                                </div>
                                                <div class="form-group col-md-4" style="display:none;">
                                                    <label for="amount">Amount</label>
                                                    <input type="number" class="form-control" id="amount" name="amount" min="1" value="1" required readonly>
                                                     <input type="number" class="form-control" id="subscription_id" name="subscription_id" value="{{$subscription_id}}" required readonly>
                                                    <!--{{ $totalprice }}-->
                                                </div>
                                            </div>    
                                            <div class="row">
                                                <div class="form-group col-md-6" id="expiration-date">
                                                    <label>Expiration Date</label><br/>
                                                    <select class="form-control" id="expiration-month" name="expiration-month" style="float: left; width: 100px; margin-right: 10px;">
                                                        @foreach($months as $k=>$v)
                                                            <option value="{{ $k }}" {{ old('expiration-month') == $k ? 'selected' : '' }}>{{ $v }}</option>                                                        
                                                        @endforeach
                                                    </select>  
                                                    <select class="form-control" id="expiration-year" name="expiration-year"  style="float: left; width: 100px;">
                                                        
                                                        @for($i = date('Y'); $i <= (date('Y') + 15); $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>            
                                                        @endfor
                                                    </select>
                                                </div>                                                
                                                <div class="form-group col-md-6" id="credit_cards" style="margin-top: 22px;">
												<!--
                                                    <img src="{{ asset('images/visa.jpg') }}" id="visa">
                                                    <img src="{{ asset('images/mastercard.jpg') }}" id="mastercard">
                                                    <img src="{{ asset('images/amex.jpg') }}" id="amex">-->
                                                </div>
                                            </div>
                                            
                                            <br/>
                                            <div class="form-group" id="pay-now">
                                                <button type="submit" class="btn btn-success themeButton" id="confirm-purchase">Confirm Payment</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>                                
                            </div>
                        </div>   
                        <div class="col-md-1"></div>
                        <div class="col-md-5" style="background: lightblue; border-radius: 5px; padding: 10px;">
                            <h3>Sample Data</h3>
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th>
                                        Owner
                                    </th>
                                    <td>
                                        Simon
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        CVV
                                    </th>
                                    <td>
                                        123
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Card Number
                                    </th>
                                    <td>
                                        4111 1111 1111 1111
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Amount
                                    </th>
                                    <td>
                                        99
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Expiration Date
                                    </th>
                                    <td>
                                        {{date('M')."-".(date('Y')+2)}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>         
                    </div>
                </div>
            </div>

        </div>
    </div> 
    <div class="clearfix"></div>
</section>        


        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

     @endsection


   @section('footer-scripts')
   <script>
   $(document).ready(function() {
	
	
   });
   </script>
		@endsection