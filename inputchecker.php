<?php

function validateRequest($required, $array)
{
$success= True;
    foreach ($required as $i) {
        if (!isset($array[$i])) {
            print($i);
            $success = False;
        }
    }
    return $success;
}
