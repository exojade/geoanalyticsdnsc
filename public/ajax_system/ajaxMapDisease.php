<?php
$where = "WHERE 1=1 and cd.barangay is not null";
$selectedDiseases = $_REQUEST['selectedDiseases'] ?? [];
$dateRange = $_REQUEST['dateRange'] ?? '';

if (!empty($dateRange)) {
    list($dateFrom, $dateTo) = explode(' to ', $dateRange);
    $where .= " AND dateCheckUp BETWEEN '$dateFrom 00:00:00' AND '$dateTo 23:59:59'";
}
// dump($where);

$diseaseIds = "''";
if(!empty($selectedDiseases)):
    $diseaseIds = "'".$selectedDiseases."'";
    // $diseaseIds = implode(",", array_map('intval', $selectedDiseases));
endif;

$string_query = "
    SELECT 
        d.diseaseId, 
        d.diseaseName, 
        d.color_code, 
        cd.barangay, 
        p.petType, 
        COUNT(*) AS total
    FROM checkup_disease cd
    LEFT JOIN disease d ON d.diseaseId = cd.diseaseId
    LEFT JOIN pet p ON p.petId = cd.petId
    $where
    AND d.diseaseId IN ($diseaseIds)
    GROUP BY d.diseaseId, d.diseaseName, cd.barangay, p.petType
";
// dump($string_query);
$results = query($string_query);
// dump($results);

$Results = [];
foreach($results as $row):
    $Results[$row["barangay"]][$row["petType"]] = $row;
endforeach;

$string_query = "
    SELECT 
        d.diseaseId, 
        d.diseaseName, 
        d.color_code, 
        cd.barangay, 
        COUNT(*) AS total
    FROM checkup_disease cd
    LEFT JOIN disease d ON d.diseaseId = cd.diseaseId
    $where
    AND d.diseaseId IN ($diseaseIds)
    GROUP BY d.diseaseId, d.diseaseName, cd.barangay
";
// dump($string_query);
$results = query($string_query);


// dump($Results);
// Initialize the dummy array
$dummyArray = [];
for ($i = 1; $i <= 40; $i++) {
    $dummyArray[$i]["dog"] = 0;
    $dummyArray[$i]["cat"] = 0;
    $dummyArray[$i]["density"] = 0;
}

// Populate the array with query results
// dump($Results);
foreach ($results as $result) {
    $barangayId = $result['barangay'];
    $diseaseId = $result['diseaseId'];
    $total = $result['total'];
    // $color = 

    if (isset($dummyArray[$barangayId])) {
        $dummyArray[$barangayId]["density"] = $total;
        if(isset($Results[$barangayId]["Dog"])):
            $dummyArray[$barangayId]["dog"] = $Results[$barangayId]["Dog"]["total"];
        endif;
        if(isset($Results[$barangayId]["Cat"])):
            $dummyArray[$barangayId]["cat"] = $Results[$barangayId]["Cat"]["total"];
        endif;


        if ($total == 0):
            $color = "";
        elseif ($total >= 1 && $total <= 300): // LOW
            $color = adjustBrightness($result["color_code"], 30); // lighten
        elseif ($total >= 301 && $total <= 800): // MEDIUM
            $color = adjustBrightness($result["color_code"], -10); // slight darken
        elseif ($total > 800): // HIGH
            $color = adjustBrightness($result["color_code"], -50); // darker
        endif;


        $dummyArray[$barangayId]["color"] = $color;
    }
    else{
        $dummyArray[$barangayId]["density"] = 0;
    }
}
// dump($dummyArray);

// Encode and return the data as JSON
echo json_encode($dummyArray);
?>