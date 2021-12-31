<?php

/*

Compute number of distinct values in an array.

*/

function solution(array $A) : int
{
    $distinctElements = [];

    for ($i = 0; $i < count($A); $i++)
        $distinctElements[$A[$i]] = 0; 

    return count($distinctElements);
}