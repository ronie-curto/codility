<?php

// brute force
function solution(array $A) : int 
{
    $maxTripletProduct = null;

    for ($i = 0; $i < (count($A) - 2); $i++)
        for ($j = $i + 1; $j < (count($A) - 1); $j++)
            for ($k = $j + 1; $k < count($A); $k++)
                if (($A[$i] * $A[$j] * $A[$k]) > $maxTripletProduct || is_null($maxTripletProduct))
                    $maxTripletProduct = $A[$i] * $A[$j] * $A[$k];

    return $maxTripletProduct;
}


//optimized
function solutionOptimized(array $A) : int 
{
    $maxValues = [null, null, null];
    $minValues = [null, null, null];
    $selectedValues = [];

    //[1, 2, 3, -5, -4, -3, 10, 20]

    if (count($A) == 3)
        return $A[0] * $A[1] * $A[2];

    // find first 3 greatest values
    for ($i = 0; $i < count($A); $i++) {
        $usedCurrentValue = 0;

        //handle max values
        if (is_null($maxValues[0]) || $A[$i] > $maxValues[0]['value']) {
            $maxValues[2] = $maxValues[1];
            $maxValues[1] = $maxValues[0];
            $maxValues[0]['value'] = $A[$i];
            $maxValues[0]['coord'] = $i;
            
            $usedCurrentValue = 1;
        }
        if ((is_null($maxValues[1]) || $A[$i] > $maxValues[1]['value']) && !$usedCurrentValue) {
            $maxValues[2] = $maxValues[1];
            $maxValues[1]['value'] = $A[$i];
            $maxValues[1]['coord'] = $i;

            $usedCurrentValue = 1;
        }
        if ((is_null($maxValues[2]) || $A[$i] > $maxValues[2]['value']) && !$usedCurrentValue) {
            $maxValues[2]['value'] = $A[$i];
            $maxValues[2]['coord'] = $i;
            $usedCurrentValue = 1;
        }
    }

    //gather max values coordinates
    $maxValuesCoordinates = [];
    foreach ($maxValues as $maxValue) {
        $maxValuesCoordinates[$maxValue['coord']] = 0;
        $selectedValues[] = $maxValue['value'];
    }


    // find the 3 lowest values below 0
    for ($i = 0; $i < count($A); $i++) {
        $usedCurrentValue = 0;

        if ($A[$i] < 0 && !array_key_exists($i, $maxValuesCoordinates)) {
            if ((is_null($minValues[0]) || $A[$i] < $minValues[0]) && !$usedCurrentValue) {
                $minValues[2] = $minValues[1];
                $minValues[1] = $minValues[0];
                $minValues[0] = $A[$i];
                $usedCurrentValue = 1;
            }
            if ((is_null($minValues[1]) || $A[$i] < $minValues[1]) && !$usedCurrentValue) {
                $minValues[2] = $minValues[1];
                $minValues[1] = $A[$i];
                $usedCurrentValue = 1;
            }
            if ((is_null($minValues[2]) || $A[$i] < $minValues[2]) && !$usedCurrentValue) {
                $minValues[2] = $A[$i];
                $usedCurrentValue = 1;
            }    
        }
    }


    //gather all values together
    foreach ($minValues as $minValue)
        if (!is_null($minValue))
            $selectedValues[] = $minValue;


    //initial max Value using only max values
    $maxTripletProduct = null;

    for ($i = 0; $i < count($selectedValues) - 2; $i++)
        for ($j = $i + 1; $j < count($selectedValues) - 1; $j++)
            for ($k = $j + 1; $k < count($selectedValues); $k++)
                if ($selectedValues[$i] * $selectedValues[$j] * $selectedValues[$k] > $maxTripletProduct || is_null($maxTripletProduct))
                    $maxTripletProduct = $selectedValues[$i] * $selectedValues[$j] * $selectedValues[$k];

    return $maxTripletProduct;
}

var_dump(solutionOptimized([1, 2, 3, -5, -4, -3, 10, 20]));
var_dump(solutionOptimized([-5, 5, -5, 4]));
var_dump(solutionOptimized([-5, 5, -5]));