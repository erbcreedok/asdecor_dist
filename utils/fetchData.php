<?php
function fsCsvToArray($pFile, $city = 'astana'){
    $pDelimiter = ',';
    $arr = [];
    if (($handle = fopen($pFile, 'r')) !== FALSE) {
        $i = 0;
        $lineArray = fgetcsv($handle, 4000, $pDelimiter, '"');
        $cityIndex = array_search($city, $lineArray);
        if ($cityIndex == 0) {
            $cityIndex = 1;
        }
        while (($lineArray = fgetcsv($handle, 4000, $pDelimiter, '"')) !== FALSE) {
            $arr[$i] = $lineArray[$cityIndex];
            $i += 1;
        }
        fclose($handle);
    }
    return $arr;
}