<?php
// Read the data from the file
$data = file_get_contents('path to free room data txt file');

// Respond with the data
header('Content-Type: application/json');
echo json_encode(['data' => $data]);
?>