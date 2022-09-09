<?php
function either($a, $b){
    $val = $a ? $a : $b;
    $args = func_get_args();
    if($val === false && count($args) > 2){
        $args = array_slice($args, 2);

        foreach($args as $arg){
            if($arg !== false){
                $val = $arg;
                break;
            }
        }
    }
    return $val;
}