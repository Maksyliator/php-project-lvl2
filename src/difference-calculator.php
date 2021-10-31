<?php

namespace difference\calculator;

function genDiff($data1, $data2)
{
    if (is_object($data1) & is_object(($data2))) {
        $data1 = get_object_vars($data1);
        $data2 = get_object_vars($data2);
        $keys = array_merge(array_keys($data1), array_keys($data2));
        sort($keys);
        $result = [];
        foreach ($keys as $key) {
            if (!array_key_exists($key, $data1)) {
                $result[' + ' . $key] = $data2[$key];
            } elseif (!array_key_exists($key, $data2)) {
                $result[' - ' . $key] = $data1[$key];
            } elseif ($data1[$key] !== $data2[$key]) {
                $result[' - ' . $key] = $data1[$key];
                $result[' + ' . $key] = $data2[$key];
            } else {
                $result['   ' . $key] = $data2[$key];
            }
        }
         //json_encode($result, JSON_PRETTY_PRINT);
    }
    return stringify($result);
}

function stringify($value, string $replacer = ' ', int $spacesCount = 1): string
{
    $iter = function ($currentValue, $depth) use (&$iter, $replacer, $spacesCount) {
        if (!is_array($currentValue)) {
            return toString($currentValue);
        }

        $indentSize = $depth * $spacesCount;
        $currentIndent = str_repeat($replacer, $indentSize);
        $bracketIndent = str_repeat($replacer, $indentSize - $spacesCount);

        $lines = array_map(
            fn($key, $val) => "{$currentIndent}{$key}: {$iter($val, $depth + 1)}",
            array_keys($currentValue),
            $currentValue
        );

        $result = ['{', ...$lines, "{$bracketIndent}}"];

        return implode("\n", $result);
    };

    return $iter($value, 1);
}

function toString($value)
{
    return trim(var_export($value, true), "'");
}
