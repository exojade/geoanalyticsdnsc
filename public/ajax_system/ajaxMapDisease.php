<?php
// dump($_REQUEST);

// use mikehaertl\pdftk\Pdf;

// $jsonString = '{"1": 16.63, "17": 351.02,"12": 5745.13,"15": 15.34,"38": 0.15,"37": 986.26,"32": 770.31,"35": 174.79,"2": 8.81,"3": 17.17,"25": 438.88,"4": 126.52,"5": 1476.91,"6": 5.69,"7": 0.55,"21": 285.21,"18": 5.57}';
$dummyArray = [];
$i = 1;
for($i=1; $i<=40;$i++):

    $dummyArray[$i] = rand(1, 999);
endfor;



// Decode JSON string to PHP associative array
// $array = json_decode($jsonString, true);
// dump($array);
// Encode the PHP array back to JSON string
$jsonEncoded = json_encode($dummyArray);

// Output the JSON string
echo $jsonEncoded;


//    dump($_POST);
?>
