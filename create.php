<!DOCTYPE html>
<html>
<head>
</head>
<body>

<h2>CREATE - AJAX</h2>
<form id="form" novalidate>
	 <div class="form-group">
		<label>First Name</label>
		<input class="form-control" id="firstName" type="text" name="firstName" placeholder="First Name" value="">
	</div>
	 <div class="form-group">
		<label>Last Name</label>
		<input class="form-control" type="text" name="lastName" placeholder="Last Name" value="">
	</div>
	<div class="form-group">
	    <label>Address Line 1</label>
	    <input class="form-control" type="text" name="addressOne" placeholder="Address Line 1" value="">
	</div>
	<div class="form-group">
	    <label>Address Line 2</label>
	    <input class="form-control" type="text" name="addressTwo" placeholder="Address Line 2" value=">">
	</div>
	<div class="form-group">
	    <label>City</label>
	    <input class="form-control" type="text" name="city" placeholder="City" value="">
	</div>
	<div class="form-group">
	    <label>Region</label>
	    <input class="form-control" type="text" name="region" placeholder="Region" value="">
	</div>
	<div class="form-group">
	    <label>Post Code</label>
	    <input class="form-control" type="text" name="postCode" placeholder="Post Code" value="">
	</div>
	<div class="form-group">
	    <label>Phone Number</label>
	    <input class="form-control" type="text" name="phoneNumber" placeholder="Phone Number" value="">
	</div>
	<div class="form-group">
	    <div class="col-md-offset-2 col-md-10">
	        <button type="submit" value="Create" class="btn btn-default">Submit</button>
	    </div>
	</div>
</form>

<!-- No need to santise form values with ajax for create - page does not refresh -->

<!-- AJAX -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<!-- Post ajax -->
<script>
$(document).ready(function() {
    $('#form').submit(function(event) {
    // Prevent form submit
    event.preventDefault();

    // Serialise
    var data = $("#form").serialize();

    // AJAX POST
    $.ajax({
        type: 'POST',
        dataType: 'json',
        data: data,
        url: "app/crud/create.php",
        success: function(data) {
            // Remove previous errors to stop repeating
            $('.errors').remove();
            $('.success').remove();

            // If errors are true - response['errors'];
            if(data.errors){
              // Error summary - loop object
              $.each(data.errorSummary, function (key, item) {
                  $("#form").before('<ul><li class="errors" style="color: #ff0000;">' + item + '</li></ul>')
              });

              // Individual errors
              $('input#firstName').after("<span class='errors' style='color: #ff0000;'>"+data.firstName+"</span>");
            }
            // If success is true - response['success'];
            else if (data.success) {
              $('#form').before("<div class='success' style='color: #00ff00;'>"+data.success+"</p>");
            }
            // If failed is true - response['failed'];
            else if (data.failed) {
              $('#form').before("<div class='errors' style='color: #ff0000;'>"+data.failed+"</p>");
            }
        }
       });
    });              
});
</script>
</body>
</html> 