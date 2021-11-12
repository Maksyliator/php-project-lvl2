<?php

namespace Differ\Formatters\Plain;

use function Functional\flatten;

function makePlainFormat(array $astTree): string
{
    $lines = plain($astTree, '');
    $joinedLine = implode("\n", flatten($lines));
    return "$joinedLine";
}

function plain(array $tree, string $path): array
{
    return array_map(function ($node) use ($path) {
        switch ($node['type']) {
            case 'updated':
                $data1Value = stringify($node['data1Value']);
                $data2Value = stringify($node['data2Value']);
                return "Property '$path{$node['key']}' was updated. From $data1Value to $data2Value";
            case 'added':
                $value = stringify($node['data2Value']);
                return "Property '$path{$node['key']}' was added with value: $value";
            case 'removed':
                return "Property '$path{$node['key']}' was removed";
            case 'unchanged':
                return [];
            case 'parent':
                $newPath = "$path{$node['key']}.";
                $children = $node['children'];
                return plain($children, $newPath);
        }
    }, $tree);
}

function stringify($value): string
{
    if (is_object($value)) {
        return "[complex value]";
    } elseif ($value === null) {
        return 'null';
    }
    return var_export($value, true);
}
