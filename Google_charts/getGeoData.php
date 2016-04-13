<?php 
require_once "../CounterManagement/CounterManager.php";
// This is just an example of reading server side data and sending it to the client.
// It reads a json formatted text file and outputs it.
$counter_manager = new CounterManager();
$counter_manager->generateGeoCurves();
$string = file_get_contents("sampleGeoData.json");
echo $string;

// Instead you can query your database and parse into JSON etc etc

?>