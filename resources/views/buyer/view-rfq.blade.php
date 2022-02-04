@extends("layouts.buyer.buyer")
@section('title', 'RFQ Detail')
@section("content")

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">View RFQ</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a>
					</li>
					<li class="breadcrumb-item"><a href="{{url('buyer/rfq-list')}}">RFQ</a>
					</li>
					<li class="breadcrumb-item active">View RFQ</li>
				  </ol>
				</div>
			  </div>
        </div>
        <div class="content-body"><!-- Sales stats -->
<style>
.table td{ border-top: 1px solid #e3ebf3; border-right: 1px solid #e3ebf3;}
.table th{
    color: #fff;
    font-weight: 400;
    font-size: 15px;
    background: #054c84;

}
.user-account blockquote{
background: #eee;
    padding: 10px;
    border-left: 3px solid #ffce0b;
    line-height: 28px;
}

</style>		
		 <section>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-12">
							
							<div class="card">
								<div class="card-content">
									<div class="card-body">
										<ul class="nav nav-tabs nav-top-border no-hover-bg nav-justified">
											<li class="nav-item">
												<a class="nav-link active" id="active-tab1" data-toggle="tab" href="#information" aria-controls="information" aria-expanded="true">General Information</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="link-tab1" data-toggle="tab" href="#items" aria-controls="items" aria-expanded="false">Items</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="linkOpt-tab1" data-toggle="tab" href="#suppliers" aria-controls="suppliers">Suppliers</a>
											</li>
										</ul>
										<div class="tab-content px-1 pt-1">
											<div role="tabpanel" class="tab-pane active" id="information" aria-labelledby="active-tab1" aria-expanded="true">
												<div class="row justify-content-start">
												    <div class="col-md-6 col-sm-12 col-12 mb-2">
													
													      <div class="table-responsive">
															   <table class="table">
																  <tbody>
																	<tr>
																	  <th scope="row">RFQ ID</th>
																	  <td><?php echo $rfq_range_list['sequence_letter'].$rfq_count; ?></td>												  
																	</tr>
																	<tr>
																	  <th scope="row">Payment Term</th>
																	  <td>
																		<?php
																			if(isset($payment_term_list) && !empty($payment_term_list)){
																				foreach($payment_term_list as $each){
																		?>
																					<?php if(isset($details['payment_term']) && $details['payment_term']==$each['id']){ echo $each['name']; }?> 
																		<?php
																				}
																			}
																		?>
																	  </td>												 
																	</tr>
																	<tr>
																	  <th scope="row">Ship Method</th>
																	  <td>
																		<?php
																			if(isset($ship_method_list) && !empty($ship_method_list)){
																				foreach($ship_method_list as $each){
																		?>
																					<?php if(isset($details['ship_method']) && $details['ship_method']==$each['id']){ echo $each['name']; }?> 
																		<?php
																				}
																			}
																		?>
																	  </td>												  
																	</tr>
																	<tr>
																	  <th scope="row">Ship Location</th>
																	  <td>
																		<?php
																			if(isset($ship_location_list) && !empty($ship_location_list)){
																				foreach($ship_location_list as $each){
																		?>
																					<?php if(isset($details['ship_location']) && $details['ship_location']==$each['id']){ echo $each['companyname']; }?>
																		<?php
																				}
																			}
																		?>
																	  </td>												  
																	</tr>
																	<tr>
																	  <th scope="row">RFQ Response Deadline</th>
																	  <td>{{$details['rfq_response_dead_line']}}</td>												  
																	</tr>
																	<tr>
																	  <th scope="row">RFQ Response Deadline Time</th>
																	  <td>{{$details['dead_line_time']}}</td>												  
																	</tr>
																	<tr>
																	  <th scope="row">Reminder</th>
																	  <td>{{$details['set_email_reminder']}}</td>												  
																	</tr>
																  </tbody>
																</table>
															
																
															</div>
													
													</div>
													
												</div>
												
												
												
											</div>
											<div class="tab-pane" id="items" role="tabpanel" aria-labelledby="link-tab1" aria-expanded="false">
												<div class="row justify-content-start">
												<div class="col-md-12 col-sm-12 col-12 mb-2">
													
													 <div class="table-responsive">
													   <table class="table">
														<thead>
													   <tr>
														
														<th>Item</th>
														<th>Unit</th>
														<th>Description</th>
														<th>Product Group</th>
														<th>Quantity</th>
														<th>Delivery Date</th>
														<th>Special Instruction</th>
														<th>Document</th>
													   </tr>
													</thead>
														  <tbody>
													@if(isset($rfq_item_list) && $rfq_item_list)
													
													<?php
													$i =1;
													
													?>
													@foreach($rfq_item_list as $eachitem)
													<?php if(isset($eachitem) && !empty($eachitem)){ $details  = $eachitem; } ?>
												    
																<tr>
																  <td>
																	<?php
																	if(isset($item_list) && !empty($item_list)){
																		foreach($item_list as $each){
																?>
																			<?php if(isset($details['item_id']) && $details['item_id']==$each['id']){ echo $each['item_number']; } ?> 
																<?php
																		}
																	}
																?>
																  </td>												  
																
																  <td>
																<?php
																	if(isset($unit_list) && !empty($unit_list)){
																		foreach($unit_list as $each){
																?>
																			<?php if(isset($details['unit']) && $details['unit']==$each['id']){ echo $each['code']; }?>
																<?php
																		}
																	}
																?>
																  </td>												 
																
																  <td>
																	<?php
																		if(isset($details['description']) && !empty($details['description'])){ echo $details['description']; }
																	?>
																  </td>												  
																
																  <td>
																	<?php
																	if(isset($product_group_list) && !empty($product_group_list)){
																		foreach($product_group_list as $each){
																?>
																		<?php if(isset($details['product_group']) && $details['product_group']==$each['id']){ echo $each['group_code']; }?>
																<?php
																		}
																	}
																?>
																  </td>												  
																
																  <td>
																	<?php
																		if(isset($details['quantity']) && !empty($details['quantity'])){ echo $details['quantity']; }
																	?>
																  </td>												  
																
																  <td>
																	<?php
																		if(isset($details['delivery_date']) && !empty($details['delivery_date'])){ echo $details['delivery_date']; }
																	?>
																  </td>												  
																
																  <td>
																	<?php
																		if(isset($details['special_instruction']) && !empty($details['special_instruction'])){ echo $details['special_instruction']; }
																	?>
																  </td>												  
																
																  <td>
																  <?php
																		$docs = App\Helpers\CommonHelper::getRfqItemDoc($details['id']);
																	?>
																	<?php 
																					if(isset($docs) && !empty($docs)){ 
																						foreach($docs as $eachdoc){
																					?><a  download href="{{asset('public/buyer/document/')}}/<?php	echo $eachdoc['document']; ?>">Download</a> | 

																						<input type="hidden" name="old_document[]" value="<?php echo $details['document']; ?>">
																				<?php	}
																					}
																				else{ 
																						
																					} 
																				?>
																  </td>												  
																</tr>
															 
													<?php
													$i++;
													?>
														@endforeach	
														 </tbody>
															</table>
													
														
													</div>
													
													</div>
													@endif	
													
													
												</div>
												    
											</div>
											
											<div class="tab-pane" id="suppliers" role="tabpanel" aria-labelledby="linkOpt-tab1" aria-expanded="false">
												<div class="row justify-content-start">
												<div class="col-md-12 col-sm-12 col-12">
													
												 <div class="table-responsive">
													   <table class="table">
													   <thead>
													   <tr>
													    <th scope="row">Name</th>
														 <th scope="row">Email</th>
													   </tr> 
													   </thead>
													   <tbody>
													@if(count($supplier_item_list) > 0)
														@foreach($supplier_item_list as $eachitem)
													
														
																	 
																		<tr>
																		 
																		  <td>{{$eachitem['company_name']}} <?php if($eachitem['status'] ==1){ echo "<span style='color:green'>-Awarded</span>"; }elseif($eachitem['status'] ==2){ echo "<span style='color:red'>-Rejected</span>"; } ?></td>												  
																	
																		 
																		  <td>{{$eachitem['email']}}</td>												 
																		</tr>
																		
																		
																	
															
														@endforeach
														  </tbody>
																	</table>
																
																	
																</div>															
														</div>
													@endif
													
												  
															
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						
							<!--<div class="card">
							   
								<div class="card-content collapse show">
									<div class="card-body card-dashboard">
									
									    <div class="table-responsive">
										   <table class="table">
											  <tbody>
												<tr>
												  <th scope="row">Name of plan</th>
												  <td>Basic</td>												  
												</tr>
												<tr>
												  <th scope="row">Number of Users</th>
												  <td>1-5</td>												 
												</tr>
												<tr>
												  <th scope="row">Price</th>
												  <td>$500</td>												  
												</tr>
												<tr>
												  <th scope="row">Start Date</th>
												  <td>September 22, 2021</td>												  
												</tr>
												<tr>
												  <th scope="row">Expiry Date</th>
												  <td>September 22, 2022</td>												  
												</tr>
											  </tbody>
											</table>
										
											
										</div>
									
									
										
									</div>
								</div>
							</div>-->
						</div>
						
						
						
					</div>
					
				
					
					
</section>


        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

     @endsection
