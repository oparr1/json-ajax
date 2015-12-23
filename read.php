<!DOCTYPE html>
<html>
<head>
</head>
<body>

<h2>Read - AJAX</h2>

<ul></ul> 
<!-- AJAX -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

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
</script>

</body>
</html> 