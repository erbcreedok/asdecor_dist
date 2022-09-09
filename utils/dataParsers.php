<?php
function parseLinks($str){
    $links = explode("\n", $str);

    $mapValues = function ($value) {
        $values = explode(';', $value);
        return array(
            "link" => trim($values[0]),
            "address" => trim($values[1]),
            "time" => trim($values[2]),
        );
    };

    return array_map($mapValues, array_filter($links));
}

function parseImages($str){
    $images = explode(",", $str);

    return array_filter(array_map('trim', $images));
}

function parseFilials($str){
    $socials = explode("\n", $str);

    $mapValues = function ($value) {
        $values = explode('—', $value);
        return array(
            "title" => trim($values[0]),
            "instagram" => trim($values[1]),
            "link" => explode('@', $values[1])[1]
        );
    };

    return array_map($mapValues, array_filter($socials));
}