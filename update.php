<!DOCTYPE html>
<html>
<head>
</head>
<body>

<ul></ul>	

<h2>Update - AJAX</h2>
<form id="form" novalidate>
	 <div class="form-group">
		<label class="required">First Name</label>
		<input class="form-control" id="firstName" type="text" name="firstName" placeholder="First Name" value="">
	</div>
	 <div class="form-group">
		<label class="required">Last Name</label>
		<input class="form-control" type="text" name="lastName" placeholder="Last Name" value="">
	</div>
	<div class="form-group">
	    <label class="required">Address Line 1</label>
	    <input class="form-control" type="text" name="addressOne" placeholder="Address Line 1" value="">
	</div>
	<div class="form-group">
	    <label class="required">Address Line 2</label>
	    <input class="form-control" type="text" name="addressTwo" placeholder="Address Line 2" value="">
	</div>
	<div class="form-group">
	    <label class="required">City</label>
	    <input class="form-control" type="text" name="city" placeholder="City" value="">
	</div>
	<div class="form-group">
	    <label class="required">Region</label>
	    <input class="form-control" type="text" name="region" placeholder="Region" value="">
	</div>
	<div class="form-group">
	    <label class="required">Post Code</label>
	    <input class="form-control" type="text" name="postCode" placeholder="Post Code" value="">
	</div>
	<div class="form-group">
	    <label class="required">Phone Number</label>
	    <input class="form-control" type="text" name="phoneNumber" placeholder="Phone Number" value="">
	</div>
	<div class="form-group">
	    <div class="col-md-offset-2 col-md-10">
	        <button type="submit" value="Create" class="btn btn-default">Update</button>
	    </div>
	</div>
</form>

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
        url: "app/crud/update.php",
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

<!-- GET $.ajax -->
<script>
// AJAX GET and REFRESH DATA - above form
setInterval(function myFunction(){ 
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: "app/crud/read.php",
        success: function(data) {
        	          
        if(data) {
          $('ul').empty();

          // READ - above form
          $.each(data, function(key, value) {
              $("ul").append("<li>"+value+"</li>");
        	});
        }
        else {
            $('ul').empty();
        }
      },
  });
    return myFunction; // start interval on page load
}(), 3000);

// AJAX FORM VALUE DATA
$.ajax({
    type: 'GET',
    dataType: 'json',
    url: "app/crud/read.php",
    success: function(data) {
                
    if(data) {
      // address inserted into form values
      $('input[name=firstName]').val(data["firstName"]);
      $('input[name=lastName]').val(data["lastName"]);
      $('input[name=addressOne]').val(data["addressOne"]);
      $('input[name=addressTwo]').val(data["addressTwo"]);
      $('input[name=city]').val(data["city"]);
      $('input[name=region]').val(data["region"]);
      $('input[name=postCode]').val(data["postCode"]);
      $('input[name=phoneNumber]').val(data["phoneNumber"]);
    }
  },
});
</script>

</body>
</html> 