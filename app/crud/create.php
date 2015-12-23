<?php
require_once("$_SERVER[DOCUMENT_ROOT]/app/config/database.php");
require_once("$_SERVER[DOCUMENT_ROOT]/app/functions/sanitise.php");

/*
Always Split up Create, Read, Update, Delete Jsons
*/

// Call the Function
$conn = mysqliConnected();

// Define Variables outside of the loop
$firstName = clean_input('firstName');
$lastName = clean_input('lastName');
$addressOne = clean_input('addressOne');  
$addressTwo = clean_input('addressTwo');
$city = clean_input('city'); 
$region = clean_input('region');
$postCode = clean_input('postCode'); 
$phoneNumber = clean_input('phoneNumber'); 

$errors = [];
$response = [];

// Error Validation Here
if (empty($firstName)) {
	$errors['firstName'] = "First name field is required";
}

// Validation Success
if (!empty($errors)) {
	$response['errors'] = true;

    // Error Summary
    $response['errorSummary'] = $errors;

    // Individual Errors
    $response['firstName'] = isset($errors['firstName']) ? $errors['firstName'] : "";
    // $response['lastName'] = isset($errors['lastName']) ? $errors['lastName'] : "";
    // $response['addressOne'] = isset($errors['addressOne']) ? $errors['addressOne'] : "";
}
else
{
	$response['errors'] = false;

	// Create the Address table 'TABLE NAME', INSERT INTO 'column names', VALUES 'VARIABLE NAMES'
	if ($statement = $conn->prepare("INSERT INTO Address (firstName, lastName, addressOne, addressTwo, city, region, postCode, phoneNumber) 
	VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) 
	{
		// s - string, i = integer, d - double, b - blob
		$statement->bind_param('ssssssss', $firstName, $lastName, $addressOne, $addressTwo, $city, $region, $postCode, $phoneNumber);
		$statement->execute();
		$response['success'] = "Record created successfully";
	}		
}

// Encode to JSON for the ajax to retrieve the data
echo json_encode($response);

$conn->close(); 
?>