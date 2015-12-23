<?php
require_once("$_SERVER[DOCUMENT_ROOT]/app/config/database.php");
require_once("$_SERVER[DOCUMENT_ROOT]/app/functions/sanitise.php");

// Call the Function
$conn = mysqliConnected();

$errors = [];
$response = [];

$firstName = clean_input('firstName');
$lastName = clean_input('lastName');
$addressOne = clean_input('addressOne');  
$addressTwo = clean_input('addressTwo');
$city = clean_input('city'); 
$region = clean_input('region');
$postCode = clean_input('postCode'); 
$phoneNumber = clean_input('phoneNumber'); 

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
else {
	$response['errors'] = false;

	// Update the Address table 'TABLE NAME', SET'column names', ? 'numbered bindValue'
	if ($statement = $conn->prepare("UPDATE Address SET firstName = ?, lastName = ?, addressOne = ?, addressTwo = ?, city = ?, region = ?, postCode = ?, phoneNumber = ? WHERE ID = ?"))
	{
		// s - string, i = integer, d - double, b - blob
		$statement->bind_param('ssssssssi', $firstName, $lastName, $addressOne, $addressTwo, $city, $region, $postCode, $phoneNumber, $ID);
		$ID = 115;
		$statement->execute();
	    $response['success'] = "Record updated successfully";
	}
}		

// Encode to JSON for the ajax to retrieve the data
echo json_encode($response);

$conn->close();
?>
