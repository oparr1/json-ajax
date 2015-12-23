<?php

// MySqli
function mysqliConnected() {
	// Variables to connect to database
   $servername = "servername";
   $username = "username";
   $password = "password";
   $dbname = "dbname";

   $conn = new mysqli($servername, $username, $password, $dbname);
   // Change to Utf8
   $conn->set_charset("utf8");

   if($conn->connect_error) {
     die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
 	}

 	// else { echo "connection is real";}

   return $conn;
}

// PDO
function pdoConnected() {
	$servername = "servername";
	$username = "username";
	$password = "password";
	$dbname = "dbname";

	try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
    }
	catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

    return $conn;
}