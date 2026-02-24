<?php
//Censura strings pelas pontas
//$length = quantia de caracteres que vão ficar visiveis
function censor_string(string $string, int $length = 3) : string
{
    $str_length = mb_strlen($string, 'UTF-8');

    if ($str_length <= $length * 2) {
        return $string;
    }

    $start = mb_substr($string, 0, $length,'UTF-8');
    $end = mb_substr($string,($length * -1),null,'UTF-8');

    return "$start***$end";
}
