<?php


function findDiscIntersections(array $array) : int 
{
	$arrayCount = count($array);
	$starts = [];
	$ends = [];
	$maxEndValue = 0;

	if ($arrayCount < 2)
		return 0;

	for ($i = 0; $i < $arrayCount; $i++) {
		$start = ($i - $array[$i] < 0) ? 0 : ($i - $array[$i]);
		$end = $i + $array[$i];

		if (isset($starts[$start])) {
			$starts[$start]++;
		} else {
			$starts[$start] = 1;
		}

		if (isset($ends[$end])) {
			$ends[$end]++;
		} else {
			$ends[$end] = 1;
		}

		if ($end > $maxEndValue)
			$maxEndValue = $end;
	}


	$i = 0;
	$openDiscs = 0;
	$intersections = 0;
	while ($i < $maxEndValue && count($starts) > 0) {
		if (array_key_exists($i, $starts)) {
			if ($starts[$i] > 0) {
				$intersections += $starts[$i] * $openDiscs + sumUntilN($starts[$i] - 1);
				$openDiscs += $starts[$i];
				unset($starts[$i]);

				if($intersections > 10000000)
					return -1;
			}
		}
		if (array_key_exists($i, $ends)) {
			if ($ends[$i] > 0)
				$openDiscs -= $ends[$i];
		}
			
		$i++;
	}

	return $intersections;
}

function sumUntilN(int $target) : int 
{
	return $target * ($target + 1) / 2;
}

var_dump(findDiscIntersections([1, 5, 2, 1, 4, 0]));