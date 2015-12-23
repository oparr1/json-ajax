<?php
require_once("$_SERVER[DOCUMENT_ROOT]/app/config/database.php");

// Call the Function
$conn = mysqliConnected();

$response = [];

// DELETE the Address table 'TABLE NAME', SET'column names', ? 'numbered bindValue'
if($statement = $conn->prepare("DELETE FROM Address WHERE ID = ?"))
{
	$ID = 115;

	// s - string, i = integer, d - double, b - blob
	$statement->bind_param('i', $ID);
	$statement->execute();

	// Check if anything was deleted
	if (mysqli_affected_rows($conn)) 
	{
		$response['success'] = "Record deleted successfully";
	}
	else {
		$response['failed'] = "Failed to delete record";
	}
}

// Encode to JSON for the ajax to retrieve the data
echo json_encode($response);

$conn->close();
?>
