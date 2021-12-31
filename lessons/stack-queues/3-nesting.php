<?php

function solution($string) 
{
    if($string == '')
        return 1;

    $stringArray = str_split($string);
    $stack = 0;

    if(count($stringArray) % 2 != 0)
        return 0;

    for($i = 0; $i < count($stringArray); $i++)
    {
        if($stringArray[$i] == '(')
            $stack++; 

        if($stringArray[$i] == ')')
        {
            if($stack == 0)
                return 0;

            $stack--;
        }
    }

    return $stack == 0 ? 1 : 0;
}