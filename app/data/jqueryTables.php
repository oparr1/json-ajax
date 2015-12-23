<?php 
require_once("$_SERVER[DOCUMENT_ROOT]/app/config/database.php");
header('Content-Type: application/json');

$conn = mysqliConnected();

$json = [];

if ($statement = $conn->prepare("SELECT code, name, continent, region, surfacearea, population, lifeexpectancy FROM country")) {
        $statement->execute();
        $result = $statement->get_result();

        while($row = $result->fetch_assoc()) {
            $json[] = $row;
        }
}

echo json_encode($json, JSON_PRETTY_PRINT);
        
$conn->close(); 
?>
