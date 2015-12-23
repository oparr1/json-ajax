<?php require_once("app/config/database.php");?>
<!DOCTYPE html>
<html>
    <head>
      <!-- bootstrap font -->
      <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    </head>

    <body>
        <h2>1) BASIC SEARCH AJAX</h2>
        <form id="form" novalidate>
          <div class="form-group">
            <input id="country" class="form-control" type="text" name="country" placeholder="Country">
          </div>
          <div class="form-group">
            <button class="button" value="button">Submit</button>
          </div>
        </form>

        <h2>2) LIVE AJAX SEARCH</h2>
        <form id="form_live" novalidate>
          <div class="form-group">
            <input id="name" class="search" type="text" name="name" placeholder="Country" style="float:left;">
            <button class="icon" value="button" style="float:left"><i class="fa fa-search"></i></button>
            <ul class="suggestion_dropdown">
            </ul>
          </div>
        </form>
        <div style="clear:both"></div>

        <h2>3) Pass functions? what matt said</h2>

        <!-- AJAX -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <!-- JSON and AJAX used to load content instantly onto the page -->

    <!-- Basic Search -->
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
            url: "app/search/jsonSimpleSearch.php",
            success: function(data) {
                    $('.country').remove();
                    // if data is not null
                    if (data && data !="") {
                      $('#country').before("<div class='country' style='color: #000;'>"+data+"</p>");
                    }
                    // if null
                    else {
                      $('#form').before("<div class='country' style='color: #000;'>"+"No search results found"+"</p>");
                    }
            },
        });              
    });
      });
  </script>
  <!-- data : data - Appends to URL for GET REQUEST --> 
  <!-- AJAX LIVE SEARCH -->
    <script type="text/javascript">
  $(document).ready(function() {

    $('#name').on('input', function() {
      var searchKeyword = $(this).val();
      // Length of input 2 or less
      if (searchKeyword.length >= 2) {
            $.ajax({
            type: 'POST',
            dataType: 'json',
            data: { name: searchKeyword },
            url: "app/search/jsonLiveSearch.php",
            success: function(data) {
              $('ul.suggestion_dropdown').empty();
              if (data) {
                  // search suggestion prepend as first in <ul>
                  $( "ul.suggestion_dropdown" ).prepend('<li class="search_suggestion">search suggestion</li>');

                  $.each(data, function(key, value) {
                        // show search suggestion
                        $('ul.suggestion_dropdown').show();

                        // close search suggestion if click outside
                        $('html').click(function() {
                          $('ul.suggestion_dropdown').hide();
                        });

                        $('ul.suggestion_dropdown').click(function(event){
                          event.stopPropagation();
                          });

                        // search suggestion data
                        $("ul.suggestion_dropdown").append('<li><a href="'+ value+'">'+ value+ '</a></li>');
                  });
              }
            },
          });
    }
  });
  });
  </script>

<!-- live search styles -->
  <style>
  .form-group {
    position:relative;
  }

  ul.suggestion_dropdown {
    display:none;
    list-style-type:none;
    position:absolute;
    top:28px;
    width: 300px;
    overflow:hidden;
    background: #666699;
    border: none;
    font-size: 14px;
    color: #262626;
    padding-left: 20px;
    color:#fff;
  }

  ul.suggestion_dropdown li {
    height:40px;
  }

  ul.suggestion_dropdown a {
    color:#fff;
    line-height:40px;
    text-decoration:none;
  }

.search {
  width: 300px;
  height: 40px;
  background: #2b303b;
  border: none;
  font-size: 14px;
  float: left;
  color: #262626;
  padding-left: 20px;
  padding-right:0px; /* firefox adds 1px padding to input */
  color: #fff;
  }

button.icon {
  -webkit-border-top-right-radius: 5px;
  -webkit-border-bottom-right-radius: 5px;
  -moz-border-radius-topright: 5px;
  -moz-border-radius-bottomright: 5px;
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
 
  border: none;
  background: #727b84;
  height: 42px;
  width: 50px;
  color: #fff;
  font-size: 10pt;
  cursor:pointer;
}

.search_suggestion {
  height:20px;
  line-height:20px;
  font-size:12px;
  text-align:right;
  padding-right:20px;
}
</style>
</body>
</html> 

