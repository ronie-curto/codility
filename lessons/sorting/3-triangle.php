<?php


function triangle(array $array) : int
{
	$arrayCount = count($array);

	if ($arrayCount < 3)
		return 0;

	sort($array);

    for($i = 0; $i < $arrayCount - 2; $i++)
        if(checkTriangle($array, $i, $i + 1, $i + 2))
            return 1;

    return 0;
}


function checkTriangle(array $array, int $p, int $q, int $r) : bool
{
  return ($array[$p] + $array[$q]) > $array[$r] && ($array[$q] + $array[$r]) > $array[$p] && ($array[$r] + $array[$p]) > $array[$q];
}

var_dump(triangle([10, 2, 5, 1, 8, 20]));
var_dump(triangle([10, 50, 5, 1]));