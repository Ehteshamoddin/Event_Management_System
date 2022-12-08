<div class="container-fluid">
	<form action="" id="manage-register" name="n"  method="post" required >
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id :'' ?>">
		<input type="hidden" name="event_id" value="<?php echo isset($_GET['event_id']) ? $_GET['event_id'] :'' ?>">
		<div class="form-group">
			<label for="" class="control-label">Full Name</label>
			<input type="text" class="form-control" name="name" required="required">
		</div>
		<div class="form-group">
			<label for="" class="control-label">Address</label>
			<textarea cols="30" rows = "2" required="" name="address" class="form-control"><?php echo isset($address) ? $address :'' ?></textarea>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Email</label>
			<input type="email" class="form-control" name="email" pattern="[^ @]*@[^ @]*"  value="<?php echo isset($email) ? $email :'' ?>" required>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Contact #</label>
			<input type="text" class="form-control" name="contact" pattern="[0-9]{10}" value="<?php echo isset($contact) ? $contact :'' ?>" required>
		</div>
	</form>
</div>
<script>
	 $('.datetimepicker').datetimepicker({
	      format:'Y/m/d H:i',
	      startDate: '+3d'
	  })

	$('#manage-register').submit(function(e){
		var x = document.forms["n"]["name"].value;
		  if(x==""){
			  alert("Name is Required");
			  return FALSE;
		  }
		  var y = document.forms["n"]["email"].value;
		  if(y==""){
			  alert("Email is Required");
			  return FALSE;
		  }else if(!y.match("[^ @]*@[^ @]*")){
			alert("Enter valid Email ");
			return false;
		  }
		  var z = document.forms["n"]["contact"].value;
		  if(z==""){
			  alert("Contact is Required");
			  return FALSE;
		  }
		  var phoneno = /^\d{10}$/;
  		 if(!z.match(phoneno)){
        	alert("Contact number must contain 10 digits");
         	return false;
         }
		e.preventDefault()
		start_load()
		$('#msg').html('')
		$.ajax({
			url:'admin/ajax.php?action=save_register',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Registration Request Sent.",'success')
						end_load()
						uni_modal("","register_msg.php")

				}
			}
		})
	})
</script>