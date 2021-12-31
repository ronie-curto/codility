<?php



var_dump(solution([23171,21011,21123,21366,21013,21367]));


function solution(array $array) : int
{
    $differences = [];

    for ($i = 1; $i < count($array); $i++)
        $differences[] = $array[$i] - $array[$i - 1];
    
    $maxEnding = 0;
    $maxSlice = 0;

    for ($i = 0; $i < count($differences); $i++) {
        $maxEnding = max(0, $maxEnding + $differences[$i]);
        $maxSlice = max($maxSlice, $maxEnding);
    }

    return $maxSlice;
}