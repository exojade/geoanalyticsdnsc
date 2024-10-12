<?php
$where = "WHERE 1=1";
$selectedDiseases = $_REQUEST['selectedDiseases'] ?? [];
$dateRange = $_REQUEST['dateRange'] ?? '';

if (!empty($dateRange)) {
    list($dateFrom, $dateTo) = explode(' to ', $dateRange);
    $where .= " AND dateCheckUp BETWEEN '$dateFrom 00:00:00' AND '$dateTo 23:59:59'";
}

$diseaseIds = "''";
if(!empty($selectedDiseases)):
    $diseaseIds = implode(",", array_map('intval', $selectedDiseases));
endif;

$string_query = "
    SELECT d.diseaseId, d.diseaseName, cd.barangay, COUNT(*) AS total
    FROM checkup_disease cd
    LEFT JOIN disease d ON d.diseaseId = cd.diseaseId
    $where
    AND d.diseaseId IN ($diseaseIds)
    GROUP BY d.diseaseId, d.diseaseName, cd.barangay
";
// dump($string_query);
$results = query($string_query);

// Initialize the dummy array
$dummyArray = [];
for ($i = 1; $i <= 40; $i++) {
    $dummyArray[$i] = array_fill_keys($selectedDiseases, 0);
}

// Populate the array with query results
foreach ($results as $result) {
    $barangayId = $result['barangay'];
    $diseaseId = $result['diseaseId'];
    $total = $result['total'];

    if (isset($dummyArray[$barangayId])) {
        $dummyArray[$barangayId][$diseaseId] = $total;
    }
}

// Encode and return the data as JSON
echo json_encode($dummyArray);
?>