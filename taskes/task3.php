<?php


function implode_full($space, $my_arr){            
    for ($i=0; $i<count($my_arr); $i++) {
        if (is_array($my_arr[$i])) 
            $my_arr[$i] = implode_full ($space, $my_arr[$i]);
    }            
    return implode($space, $my_arr);
}
$result= implode_full(' ', array(array('a','b','c'),array('x','b','a'),array('z','z','v')));
$result_r=str_split($result);
print_r(array_unique($result_r));




?>