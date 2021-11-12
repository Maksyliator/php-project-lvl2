<?php

namespace Difference\Formatters\Stylish;

const NUMBERINDENTS = 4;

function makeStylishFormat(array $astTree): string
{
    return stylish($astTree);
}

function stylish(array $astTree, int $depth = 0): string
{
    $indent = buildIndent($depth, NUMBERINDENTS);
    $result = array_map(function ($node) use ($depth, $indent) {
        $depth += 1;
        switch ($node['type']) {
            case 'parent':
                return $indent . "    " . $node['key'] . ": " . stylish($node['children'], $depth) . "\n";
            case 'added':
                $valueAdded = stringify($node['data2Value'], $depth);
                return $indent . "  + " . $node['key'] . ": " . $valueAdded . "\n";
            case 'removed':
                $valueRemoved = stringify($node['data1Value'], $depth);
                return $indent . "  - " . $node['key'] . ": " . $valueRemoved . "\n";
            case 'updated':
                $valueRemoved = stringify($node['data1Value'], $depth);
                $valueAdd = stringify($node['data2Value'], $depth);
                $nodeRemoved = $node['key'] . ": " . $valueRemoved . "\n";
                $nodeAdd = $node['key'] . ": " . $valueAdd;
                return $indent . "  - " . $nodeRemoved . $indent . "  + " . $nodeAdd . "\n";
            case 'unchanged':
                $valueUnchanged = stringify($node['data1Value'], $depth);
                return $indent . "    " . $node['key'] . ": " . $valueUnchanged . "\n";
        }
    }, $astTree);
    return '{' . "\n" . implode("", $result) . $indent . '}';
}

function buildIndent(int $depth, int $numberOfIndents): string
{
    return str_repeat(" ", $depth * $numberOfIndents);
}

function stringify($value, int $depth): string
{
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    } elseif (is_null($value)) {
        return 'null';
    } elseif (!is_object($value)) {
        return (string) $value;
    }
    $indent = buildIndent($depth, NUMBERINDENTS);
    $stringOfArray = array_map(function ($key, $item) use ($depth, $indent) {
        $depth += 1;
        $typeOfValueOfNode = (is_object($item)) ? stringify($item, $depth) : $item;
        return $indent . "    " . "$key: " . $typeOfValueOfNode . "\n";
    }, array_keys(get_object_vars($value)), get_object_vars($value));
    return '{' . "\n" . implode("", $stringOfArray) . $indent . '}';
}
