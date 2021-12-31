<?php


var_dump(countDivisibleNumbers(0,2,2));

function countDivisibleNumbers(int $start, int $end, int $divisibleNumber) : int
{
    if ($start == $end && ($start % $divisibleNumber) == 0)
        return 1;

    if($divisibleNumber == 1)
        return $end - $start + 1;

    $countBeforeStart = $start > 0 ? findTarget($divisibleNumber, SumDivisibleBy($divisibleNumber, $start - 1)) : -1;
    $countTillEnd = findTarget($divisibleNumber, SumDivisibleBy($divisibleNumber, $end));

    return $countTillEnd - $countBeforeStart;
}

function SumDivisibleBy(int $divisionNumber, int $oldTarget) : int
{
    $newTarget = floor($oldTarget / $divisionNumber);
    return floor(($divisionNumber * ($newTarget * ($newTarget + 1))) / 2);
}

function findTarget(int $divisionNumber, int $somatory) : int
{
    $squareRoot = (($divisionNumber / 2)**2 + 2 * $divisionNumber * $somatory) ** 0.5;
    return (-1 * $divisionNumber / 2 + $squareRoot) / $divisionNumber;
}