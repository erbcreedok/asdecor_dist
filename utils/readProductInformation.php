<?php
include 'dataParsers.php';

function readProductInformation($pFile, $productId){
    $pDelimiter = ',';
    $product = false;
    if (($handle = fopen($pFile, 'r')) !== FALSE) {
        $i = 0;
        error_log($i);
        error_log(json_encode($productId));
        while (($lineArray = fgetcsv($handle, 4000, $pDelimiter, '"')) !== FALSE) {
            if ($lineArray[0] == $productId) {
                $product = array(
                    'code' => $lineArray[0],
                    'title' => $lineArray[2],
                    'category' => $lineArray[3],
                    'price' => $lineArray[4],
                    'old_price' => $lineArray[5],
                    'description' => $lineArray[6],
                    'images' => parseImages($lineArray[7]),
                    'characteristics' => $lineArray[9],
                    'shortDescription' => $lineArray[10],

                );
                error_log(json_encode($product));
                break;
            }
            $i += 1;
        }
        fclose($handle);
    }
    return $product;
}