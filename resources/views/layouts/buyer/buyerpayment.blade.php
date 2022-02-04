<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
@include("partial.buyer.css")
</head>
   <body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">

   
    @include("partial.buyer.header")
	  @include("partial.buyer.sidemenu")
	
	 @yield("content")
	 
	 <footer class="footer footer-static footer-light navbar-border">
      <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright  &copy; 2021 
	  Quoteside, All rights reserved. </span>
	  </p>
    </footer>
   @include("partial.buyer.js")
	
	
	
    <script>
	
  function deleteFunccom(model,id){
    if(confirm("All data related to this company will be deleted, including users, ad RFQs etc.")){
      window.location.href = "{{ url('/buyer/deleteByID') }}/"+model+'/'+id;
    }
    else{
      return false;
    }

  }
  function deleteFunc(model,id){
    if(confirm("Are you sure you want to delete this?")){
      window.location.href = "{{ url('/buyer/deleteByID') }}/"+model+'/'+id;
    }
    else{
      return false;
    }

  }

  function editFunc(id){
    $('#label_field_div_'+id).hide();
    $('#text_field_div_'+id).show();
    
  }
  function updateByID(model,id){
    var value = $("#name_"+id).val();
    if(value){
      window.location.href = "{{ url('/buyer/updateByID') }}/"+model+'/'+id+'/'+value;
    }
    else{
      alert("Please enter value");
      return false;
    }

  }

      </script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    @yield('footer-scripts') 
    <!-- END PAGE LEVEL JS-->
<script>
$(document).ready(function(){
	$('#exported_data').DataTable({
	   dom: 'Bfrtip',
	   buttons: [
	   {
			extend: 'excel',
			text: 'Export to Excel',
			className: 'btn btn-default',
			exportOptions: {
				columns: ':not(.notexport)'
			}
		}]
	});
	$.ajaxSetup({
		headers:
			{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	});
	
	 
});
</script>
	
  </body>
</html>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
