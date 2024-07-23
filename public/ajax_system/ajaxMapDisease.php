<?php
// dump($_REQUEST);

// use mikehaertl\pdftk\Pdf;



// if($_REQUEST["dateRange"] != ""):
//     $where = "";
//     list($dateFrom, $dateTo) = explode(' to ', $_REQ);
// endif;

$where = " where 1=1";


$selectedDiseases = [];
if (isset($_REQUEST["parvo"]) && $_REQUEST["parvo"] == "true") {
    $selectedDiseases[] = 'parvo';
}
if (isset($_REQUEST["dengue"]) && $_REQUEST["dengue"] == "true") {
    $selectedDiseases[] = 'dengue';
}
if (isset($_REQUEST["flu"]) && $_REQUEST["flu"] == "true") {
    $selectedDiseases[] = 'flu';
}


if($_REQUEST["dateRange"] != ""):
 
    list($dateFrom, $dateTo) = explode(' to ', $_REQUEST["dateRange"]);
    $dateFrom .= ' 00:00:00';
    $dateTo .= ' 00:00:00';
    $where .= " and dateCheckUp between '".$dateFrom."' and '".$dateTo."'";
endif;

$string_query = "SELECT d.diseaseName, cd.barangay, COUNT(*) AS total
FROM checkup_disease cd
LEFT JOIN disease d ON d.diseaseId = cd.diseaseId
".$where."
GROUP BY d.diseaseName, cd.barangay";
// dump($string_query);
$results = query($string_query);



// $jsonString = '{"1": 16.63, "17": 351.02,"12": 5745.13,"15": 15.34,"38": 0.15,"37": 986.26,"32": 770.31,"35": 174.79,"2": 8.81,"3": 17.17,"25": 438.88,"4": 126.52,"5": 1476.91,"6": 5.69,"7": 0.55,"21": 285.21,"18": 5.57}';
$dummyArray = [];
for ($i = 1; $i <= 40; $i++) {
    $dummyArray[$i] = [
        'parvo' => 0,
        'dengue' => 0,
        'flu' => 0
    ];
}

// Populate the array with the query results
foreach ($results as $result) {
    $barangayId = $result['barangay'];
    $diseaseName = strtolower($result['diseaseName']);
    $total = $result['total'];

    if (isset($dummyArray[$barangayId])) {
        $dummyArray[$barangayId][$diseaseName] = $total;
    }
}

// Filter out unselected diseases
foreach ($dummyArray as &$barangay) {
    if (!in_array('parvo', $selectedDiseases)) {
        $barangay['parvo'] = 0;
    }
    if (!in_array('dengue', $selectedDiseases)) {
        $barangay['dengue'] = 0;
    }
    if (!in_array('flu', $selectedDiseases)) {
        $barangay['flu'] = 0;
    }
}
// dump($dummyArray);
// Encode the PHP array to JSON
$jsonEncoded = json_encode($dummyArray);

// Output the JSON string
echo $jsonEncoded;


//    dump($_POST);
?>
