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
                    'title' => $lineArray[1],
                    'category' => $lineArray[2],
                    'price' => $lineArray[3],
                    'old_price' => $lineArray[4],
                    'description' => parseDescription($lineArray[5]),
                    'shortDescription' => $lineArray[6],
                    'images' => parseImages($lineArray[7]),
                    'more_link' => $lineArray[8],
                    'advantages' => parseDescription($lineArray[9]),
                    'characteristics' => parseDescription($lineArray[10]),
                    'additional' => parseDescription($lineArray[11]),
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