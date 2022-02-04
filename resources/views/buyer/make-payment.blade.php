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
				<h3 class="content-header-title">Pricing</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.html">Home</a>
					</li>
					<li class="breadcrumb-item active">Pricing
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
	?>
		<div class="col-xl-4 col-md-6 col-12">
            <div class="card profile-card-with-cover pricing_box pricing_selected">
                <div class="card-content card-deck text-center">
			        <div class="card box-shadow">
			          <div class="card-header pb-0">
					    <div class="text-center mb-2"><img src="app-assets/images/basic.png" /> </div>
			            <h2 class="my-0 font-weight-bold">After Discount</h2>
			          </div>
			          <div class="card-body">
			            <h1 class="pricing-card-title">$<?php echo $totalprice; ?> <small class="text-muted">/ Month</small></h1>
			            <ul class="list-unstyled mt-2 mb-2">
			              <li>1-5 Users</li>
			            </ul>
			           <a href="{{url('buyer/pay')}}/{{$companyData['no_of_users']}}"  class="btn-lg btn-block btn-info disabled">Select</a>
			          </div>
			        </div>
                </div>
            </div>
        </div>
	<?php
		}else{
			if(isset($price_list) && !empty($price_list)){
				foreach($price_list as $eachprice){
	?>
				<div class="col-xl-4 col-md-6 col-12">
					<div class="card profile-card-with-cover pricing_box <?php if($companyData['no_of_users'] == $eachprice['id']){ ?>pricing_selected <?php } ?>">
						<div class="card-content card-deck text-center">
							<div class="card box-shadow">
							  <div class="card-header pb-0">
								<div class="text-center mb-2"></div>
								<h2 class="my-0 font-weight-bold">{{$eachprice['name']}}</h2>
							  </div>
							  <div class="card-body">
								<h1 class="pricing-card-title">
								    <?php
								        if(!empty($eachprice['price'])){
								    ?>
								    $<?php echo $eachprice['price']; ?> <small class="text-muted">/ year</small>
								    <?php
								        }else{
						            ?>
						                Call us for special licensing pricing

						            <?php
								        }
								    ?>    
							    </h1>
								<ul class="list-unstyled mt-2 mb-2">
								  <li>
									@if($eachprice['end_to'] == 0)
										> {{$eachprice['start_from']}}
									@else
										{{$eachprice['start_from']}} - {{$eachprice['end_to']}}
									@endif
								  Users</li>
								</ul>
								 <?php
								        if(!empty($eachprice['price'])){
								    ?>
								<a href="{{url('buyer/pay')}}/{{$eachprice['id']}}"  class="btn-lg btn-block btn-info disabled">Select</a>
								<?php
								        }
								?>
							  </div>
							</div>
						</div>
					</div>
				</div>
	<?php
				}
			}
	?>
	
	<?php
		}
	 ?>

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
	
	
   });
   </script>
		@endsection