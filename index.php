<?php require_once("app/config/database.php");?>
<!DOCTYPE html>
<html>
    <head>
    </head>

    <!-- AJAX - GET/POST to EXTERNAL SOURCE -->

    <body>
        <h2>1) getJSON to ul</h2>
        <ul class="mysqli">
        </ul>

        <h2>2) getJSON to Table</h2>
        <table class="json">
            <tr>
            </tr>
        </table>

        <h2>2) $.AJAX GET </h2>
        <ul class="json"></ul>

        <h2>4) JSON to PHP without ajax</h2>
        
        <!-- Get JSON through file_get_contents -->
        <?php $jsonPHP = json_decode(file_get_contents("$_SERVER[DOCUMENT_ROOT]/app/data/jsonData.json"), true); // true to convert to array
              $jsonData = json_decode(file_get_contents('http://localhost:4173/app/data/json.php'), true); // __DIR__ - create backslashes on windows
         ?>

         <!-- Get JSON through cURL -->

         <?php
        // intiate curl
        $curl = curl_init(); 
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => 'http://localhost:4173/app/data/jsonData.json'
        ));            
        // Execute - sends the GET request
        $result=curl_exec($curl);
        // Closing
        curl_close($curl);
        // decode json
        $curlJson = json_decode($result, true);
         ?>

         <h4>cURL JSON</h4>

         <table>     
             <?php foreach ($curlJson as $row) : ?>
                <tr>
                     <td><?php echo $row['code']; ?></td>
                     <td><?php echo $row['name']; ?></td>
                     <td><?php echo $row['continent']; ?></td>
                </tr>
             <?php endforeach; ?>   
        </table>

        </br>

        <h4>file_get_contents jsonphp</h4>

         <!-- JSON PHP -->
         <table>     
             <?php foreach ($jsonPHP as $row) : ?>
                <tr>
                     <td><?php echo $row['code']; ?></td>
                     <td><?php echo $row['name']; ?></td>
                     <td><?php echo $row['continent']; ?></td>
                </tr>
             <?php endforeach; ?>   
        </table>

        </br>

        <h4>file_get_contents json data</h4>

        <!-- JSON DATA -->
         <table>     
             <?php foreach ($jsonData as $row) : ?>
                <tr>
                     <td><?php echo $row['code']; ?></td>
                     <td><?php echo $row['name']; ?></td>
                     <td><?php echo $row['continent']; ?></td>
                </tr>
             <?php endforeach; ?>   
        </table>

        <!-- AJAX -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <!-- JSON and AJAX used to load content instantly onto the page -->

        <!-- Get JSON -->
        <script type='text/javascript'>
        $(document).ready(function(){
        $.getJSON( "app/data/json.php", function(data) {
          $.each(data, function(key, value) {
            $("ul.mysqli").append("<li>"+value.code+"</li>"+
                           "<li>"+value.name+"</li>"+
                           "<li>"+value.continent+"</li>"

                );
          });
        });

        });
        </script>

        <!-- Get JSON to table -->
        <script type='text/javascript'>
        $(document).ready(function(){
        $.getJSON( "app/data/jsonData.json", function(data) {
                var tr;
                for (var i = 0; i < data.length; i++) {
                    tr = $('<tr/>');
                    tr.append("<td>" + data[i].code + "</td>");
                    tr.append("<td>" + data[i].name + "</td>");
                    tr.append("<td>" + data[i].continent + "</td>");
                    $('table.json').append(tr);
                }
        });

        });
        </script>

        <!-- GET $.ajax -->
        <script>
        $(document).ready(function(){
            // AJAX POST
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: "app/data/jsonData.json",
                success: function(data) {
                  $('ul.json').empty();
                  $.each(data, function(key, value) {
                    $("ul.json").append("<li>"+value.code+" "+value.name+" "+value.continent+"</li>"
                  );
                });
              },
          });
        });
        </script>
    </body>
</html> 

