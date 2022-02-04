@section('content')
<form id="addShipMethodpopupForm" class="form-horizontal form-simple" method="POST" action="{{url('supplier/submititemQuoteFormApiPopup')}}" novalidate>
@csrf
<div class="table-responsive">	
<p style="text-align:center;"><b>Your quote for the following items is not the lowest. Would you like to Revise?</b> </p>
<table class="table table-striped table-bordered">
	 <thead>
	   <tr>
		
		<th>Item</th>
		<th>Unit</th>
		<th>Quantity</th>
		<th>Product Group</th>
		<th>Delivery Date</th>
		<th>Document</th>
		<th>Quote/Unit</th>
	   </tr>
	</thead>
	<tbody>


<?php
	$items = $rfq_items;
?>
@if(count($items) > 0)
	
		<?php $i = 0; ?>
		@foreach($items as $eachitem)
	
			<tr>
		
			<?php
				$getItemDetails = App\Helpers\CommonHelper::getItemDetails($eachitem);
				$quotes = App\Helpers\CommonHelper::getQuotevalue($eachitem,$item_list);
			?>
				<td>{{$getItemDetails[0]->item_number}}</td>
				<td>{{$getItemDetails[0]->code}}</td>
				<td>{{$getItemDetails[0]->quantity}}</td>
				<td>{{$getItemDetails[0]->group_code}}</td>
				<td>{{$getItemDetails[0]->delivery_date}}</td>
				<td>
				 <?php
					$docs = App\Helpers\CommonHelper::getRfqItemDoc($eachitem);
					?>
					<?php 
									if(isset($docs) && !empty($docs)){ 
										foreach($docs as $eachdoc){
									?><a  download href="{{asset('public/buyer/document/')}}/<?php	echo $eachdoc['document']; ?>">Download</a> | 

									
								<?php	}
									}
								else{ 
										
									} 
								?>
				</td>
				<td>
					<?php 
					//	if(isset($quote[$i]) && !empty($quote[$i])){ 
					//		echo $quote[$i];
					//	}else{
					?>
				
							<p><?php if(isset($quote[$i]) && !empty($quote[$i])){ echo $quote[$i]; } ?></p>
							<input type="hidden" name="quote[]" value="<?php if(isset($quote[$i]) && !empty($quote[$i])){ echo $quote[$i]; } ?>" <?php if(isset($quote[$i]) && !empty($quote[$i])){ echo "readonly";; } ?>>
							<input type="hidden" name="rfq_items[]" value="{{$eachitem}}">
							<input type="hidden" name="rfq_item_send_id[]" value="{{$item_list}}">
							<input type="hidden" name="rfq_id[]" value="{{$rfq_id}}">
							
							
					<?php
					//	}
					?>
					
					
					
				</td>
				
				
				
			</tr>
		<?php $i++; ?>
		@endforeach
		
			<tr>
				<td colspan="7">
						<button type="submit" class="btn btn-info round btn-min-width its_ok_btn">
						It's OK
					</button>
					<button type="button" class="btn btn-danger round want_to_revise" >
						I want to Revise
					</button>
				</td>
			</tr>
		
		
			
	
@endif
	

	</tbody>
	
</table>	
</div>	
	</form>
@stop
