<?php

var_dump(solution([4, 2, 2, 5, 1, 5, 8]));

function solution(array $A) : int
{
    $arrayCount = count($A);

    if ($arrayCount < 2 || $arrayCount > 100000)
        throw new Exception('N out of limits.');

    $foundValues = [];

    //calculating prefix sum
    $prefixSum[0] = 0;
    for ($i = 1; $i <= $arrayCount; $i++) {
        $prefixSum[$i] = $prefixSum[$i - 1] + $A[$i - 1];
        $foundValues[$A[$i - 1]][] = $i - 1;
    }

    //initial minimal average > all values
    $minimalAverage = [
        'position' => 0, 
        'value' => calculateAverage(0, $arrayCount, $prefixSum)
    ];

    //checking if all values are the same. 
    if (count($foundValues) == 1)
        return 0;

    //size of slice
    for ($i = 2; $i < $arrayCount; $i++) {
        for ($k = 0; $k < $arrayCount - $i + 1 ; $k++) {
            $currentAverage = calculateAverage($k, $k + $i, $prefixSum);

            if ($currentAverage < $minimalAverage['value']) {
                $minimalAverage['value'] = $currentAverage;
                $minimalAverage['position'] = $k;
            }
        }
    }

    return $minimalAverage['position'];
}

function calculateAverage(int $start, int $end, array $prefixSum) : float
{
    return ($prefixSum[$end] - $prefixSum[$start]) / ($end - $start);
}