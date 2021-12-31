<?php


var_dump(solution([3,2,-6,4,0]));
var_dump(solution([-10]));

function solution(array $array) : int
{
    $maxEnding = PHP_INT_MIN;
    $maxSlice = PHP_INT_MIN;

    for ($i = 0; $i < count($array); $i++) {
        $maxEnding = max($array[$i], $maxEnding + $array[$i]);
        $maxSlice = max($maxSlice, $maxEnding);
    }

    return $maxSlice;
}