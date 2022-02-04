

<form id="addShipMethodForm" class="form-horizontal form-simple" method="POST" action="{{ url('buyer/submitaddRfqItemFormApi') }}" novalidate enctype="multipart/form-data">
@csrf
	@if(isset($id) && $id)
		<input type="hidden" name="id" value="{{$id}}">
	@endif
	@if(isset($rfq_id) && $rfq_id)
		<input type="hidden" name="rfq_id" value="{{$rfq_id}}">
	@endif

	<div class="form-body">
		<div class="row">
			<div class="col-md-6 col-sm-12 col-12">
				<div class="form-group">
					<label for="item_id">Item*</label>
					<select data="new" id="item_id" name="item_id" class="item_id form-control">
						<option value="" selected="">Select Item</option>
						<?php
							if(isset($item_list) && !empty($item_list)){
								foreach($item_list as $each){
						?>
									<option value="<?php echo $each['id']; ?>"><?php echo $each['item_number']; ?></option>
						<?php
								}
							}
						?>
					</select>
				</div>
			</div>
			<div class="col-md-6 col-sm-12 col-12">
				<div class="form-group">
					<label for="unit_new">Unit*</label>
					<select id="unit_new" name="unit" class="form-control" readonly="readonly">
						<option value="">Select Unit</option>
						<?php
							if(isset($unit_list) && !empty($unit_list)){
								foreach($unit_list as $each){
						?>
									<option <?php if(isset($unit_measure) && !empty($unit_measure) && ($each['id'] == $unit_measure)){ echo "selected";  }?> value="<?php echo $each['id']; ?>"><?php echo $each['code']; ?></option>
						<?php
								}
							}
						?>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-sm-12 col-12">
				<div class="form-group">
					<label for="description_new">Description</label>
					<input  id="description_new" type="text" name="description" class="form-control">
				</div>
			</div>
			<div class="col-md-6 col-sm-12 col-12">
				<div class="form-group">
					<label for="product_group_new">Product Group</label>
					
					<select id="product_group_new" name="product_group" class="form-control" readonly="readonly">
						<option value="">Select Product Group</option>
						<?php
							if(isset($product_group_list) && !empty($product_group_list)){
								foreach($product_group_list as $each){
						?>
									<option <?php if(isset($product_group) && !empty($product_group) && ($each['id'] == $product_group)){ echo "selected";  }?> value="<?php echo $each['id']; ?>"><?php echo $each['group_code']; ?></option>
						<?php
								}
							}
						?>
					</select>
					
				
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-sm-12 col-12">
				<div class="form-group">
					<label for="quantity">Quantity</label>
					<input type="number" id="quantity" class="form-control" name="quantity">
				</div>
			</div>
			<div class="col-md-6 col-sm-12 col-12">
				<div class="form-group">
					<label for="set_email_reminder">Delivery Date</label>
					<input type="date" id="delivery_date" class="form-control" name="delivery_date">
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6 col-sm-12 col-12">
				<div class="form-group">
					<label for="set_email_reminder">Special Instruction</label>
					<textarea id="special_instruction" class="form-control" name="special_instruction"></textarea>

				</div>
			</div>
			<div class="col-md-6 col-sm-12 col-12">
				<div class="form-group">
					<label for="set_email_reminder">Attachment</label>
					<input type="file" name="document[]" multiple>

				</div>
			</div>
		</div>
		
	</div>

	<div class="form-actions text-right">
		<?php
			if(isset($rfq_id) && !empty($rfq_id)){ 
		?>
				<button type="submit" class="btn btn-info round btn-min-width">
					Save 
				</button>
		<?php
			}else{
		?>
				<button disabled type="submit" class="btn btn-info round btn-min-width">
					Save 
				</button>
		<?php
			}
		?> 
		
		<?php
			if(isset($rfq_id) && !empty($rfq_id)){ 
		?>
				<!--<input value="Save and Exit" type="submit" name="save_exit" class="btn btn-info round btn-min-width save_exit">
				<button  type="button" class="btn btn-info round btn-min-width save_exit">
					 Exit
				</button>-->
				
					
		<?php
			}else{
		?>
				<!--<button disabled type="button" class="btn btn-info round btn-min-width save_exit">
					 Exit
				</button>-->
		<?php
			}
		?>
		
	</div>
</form>
					
<script>
//$('select[readonly="readonly"] option:not(:selected)').attr('disabled',true);
</script>					