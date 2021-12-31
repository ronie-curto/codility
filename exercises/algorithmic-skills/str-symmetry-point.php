<?php


var_dump(solution("racecar"));

function solution(string $string) : int
{
    $stringLength = strlen($string);

    if ($stringLength == 0 || ($stringLength - 1) % 2 != 0)
        return -1;

    if ($stringLength == 1)
        return 0;

    $mid = (($stringLength - 1) / 2) + 1;

    $leftSide = substr($string, 0, $mid - 1);
    $rightSideReversal = strrev(substr($string, $mid));

    if ($leftSide == $rightSideReversal)
        return $mid - 1;

    return -1;
}