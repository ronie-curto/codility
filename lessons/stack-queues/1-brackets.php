<?php

function solution(string $string) : int
{
    if ($string == '')
        return 1;
        
    $stringArray = str_split($string);
    $stack = [];
    $size = 0;

    if (count($stringArray) % 2 != 0)
        return 0;

    for ($i = 0; $i < count($stringArray); $i++) {
        if (preg_match('/[{\[\(]/', $stringArray[$i])) {
            $stack[$size] = $stringArray[$i];
            $size++;
        } elseif (preg_match('/[}\]\)]/', $stringArray[$i])) {
            if ($size == 0)
                return 0;

            if (getClosingParenthesis($stack[$size - 1]) != $stringArray[$i])
                return 0;

            unset($stack[$size - 1]);
            $size--;
        } else {
            return 0;
        }
    }

    return count($stack) == 0 ? 1 : 0;
}

function getClosingParenthesis(string $parenthesis) : string
{
    if($parenthesis == '{')
        return '}';

    if($parenthesis == '[')
        return ']';

    if($parenthesis == '(')
        return ')';

    return '';
}