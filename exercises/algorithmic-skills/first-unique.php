<?php

var_dump(solution([4, 10, 5, 4, 2, 10]));

function solution(array $array) : int 
{
    if (count($array) == 0)
        return -1;

    $uniqueNumbers = [];

    for ($i = 0; $i < count($array); $i++)
        if (array_key_exists($array[$i], $uniqueNumbers)) {
            $uniqueNumbers[$array[$i]]++;
        } else {
            $uniqueNumbers[$array[$i]] = 1;
        }

    foreach ($uniqueNumbers as $numberValue => $numberCount)
        if ($numberCount == 1)
            return $numberValue;

    return -1;
}