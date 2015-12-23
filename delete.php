<!DOCTYPE html>
<html>
<body>

<ul></ul>	

<h2>Delete - AJAX</h2>

<form id="form" novalidate>
	<div class="form-group">
	    <div class="col-md-offset-2 col-md-10">
	        <button type="submit" value="Create" class="btn btn-default">Delete</button>
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
        url: "app/crud/delete.php",
        success: function(data) {
            // Remove previous errors to stop repeating
            $('.errors').remove();
            $('.success').remove();

            // If success is true - response['success'];
            if (data.success) {
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
                      
        if (data) {
          // Stop repeating
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
</script>

</body>
</html> 