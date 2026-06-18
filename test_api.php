<?php
$url = 'http://127.0.0.1:8000/autocomplete/doctor-names?q=md';
$response = file_get_contents($url);
echo "Raw Response:\n";
echo $response;
echo "\n\nResponse Length: " . strlen($response);
?>
