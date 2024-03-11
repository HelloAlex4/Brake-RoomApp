<?php
$command = 'curl Command to  get data';

$allRooms = ['Z101', 'Z102', 'Z103', 'Z201', 'Z204', 'Z205', 'Z206', 'Z207', 'Z208', 'Z209', 'Z210', 'Z211', 'Z212', 'Z214', 'Z215', 'Z216', 'Z217', 'Z218', 'Z222', 'Z223', 'Z224', 'Z225', 'Z226', 'Z301', 'Z303', 'Z304', 'Z305', 'Z306', 'Z307', 'Z309', 'Z310', 'Z311', 'Z312', 'Z314', 'Z315', 'Z316', 'Z317', 'Z320', 'Z401', 'Z403', 'Z404', 'Z405', 'Z406', 'Z407', 'Z408', 'Z409', 'Z412', 'Z413', 'Z414', 'Z415', 'Z416', 'Z417', 'Z418', 'Z420', 'Z421', 'Z422', 'A', 'B', 'C', 'D'];
$response = shell_exec("$command 2>&1");
$emptyRooms = array();
// Split the response into header and body parts
list(, $body) = explode("\r\n\r\n", $response, 2);
$body = json_decode($body, true);
// Output only the body
$body = $body["data"];


foreach ($body as $justBody) {
    if(in_array($justBody["roomName"], $allRooms)){
        $datetime = $justBody["lessonDate"]. " ". $justBody["lessonEnd"]. ",". $justBody["start"] ;
        if(!array_key_exists($datetime, $emptyRooms)){
            $emptyRooms[$datetime] = $allRooms;
        }
        
        if(($key = array_search($justBody["roomName"], $emptyRooms[$datetime])) !== false){
            unset(($emptyRooms[$datetime])[$key]);
        }
    }
}

$emptyRooms = json_encode($emptyRooms);



$file_path = 'path to File';

// Open the file with 'w' mode to truncate it before writing
$file_handle = fopen($file_path, 'w');

if ($file_handle !== false) {
    // Write data to file
    if (fwrite($file_handle, $emptyRooms) !== false) {
        echo "Data written successfully.";
    } else {
        echo "Error writing data to file.";
    }
    
    // Close the file handle
    fclose($file_handle);
} else {
    echo "Error opening file for writing.";
}
?>