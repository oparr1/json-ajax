<?php
require_once("$_SERVER[DOCUMENT_ROOT]/app/config/database.php");

// Call the Function
$conn = mysqliConnected();

$response = [];

// Mysqli Query - READ
if ($statement = $conn->prepare("SELECT firstName, lastName, addressOne, addressTwo, city, region, postCode, phoneNumber 
                             FROM Address 
                             WHERE ID = ?")) {
	$ID = 115;

	$statement->bind_param('i', $ID);
	$statement->execute();

	$result = $statement->get_result();
	$response = $result->fetch_assoc();
}

// Encode to JSON for the ajax to retrieve the data
echo json_encode($response);

$conn->close();
?>
