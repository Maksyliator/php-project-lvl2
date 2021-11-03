<?php

namespace stylish;

use phpDocumentor\Reflection\Types\Mixed_;

function stylish(array $value): string
{
    $space = ' ';
    $spacesCount = 2;
    $iter = function ($currentValue, $depth) use (&$iter, $space, $spacesCount) {
        if (!is_array($currentValue)) {
            return toString($currentValue);
        }
        $indentSize = $depth * $spacesCount;
        $currentIndent = str_repeat($space, $indentSize);
        $bracketIndent = str_repeat($space, $indentSize - $spacesCount);
        $lines = array_map(
            fn($key, $val) => "$currentIndent$key: {$iter($val, $depth + 2)}",
            array_keys($currentValue),
            $currentValue
        );
        $result = ['{', ...$lines, "$bracketIndent}"];
        return implode("\n", $result);
    };
    return $iter($value, 1);
}

function toString($value): string
{
    return trim(var_export($value, true), "'");
}
