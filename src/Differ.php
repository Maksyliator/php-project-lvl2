<?php

namespace Differ\Differ;

use function Differ\Parsers\convertingFile;
use function Differ\Formatters\formatSelection;
use function Functional\sort;

function genDiff(string $pathToFirstFile, string $pathToSecondFile, string $formatter = 'stylish'): string
{
    $firstFileContent = file_get_contents(__DIR__ . $pathToFirstFile, true);
    $secondFileContent = file_get_contents(__DIR__ . '/../' . $pathToSecondFile, true);
    $extensionFirstFile = pathinfo($pathToFirstFile, PATHINFO_EXTENSION);
    $extensionSecondFile = pathinfo($pathToSecondFile, PATHINFO_EXTENSION);
    $dataFirstFile = convertingFile($firstFileContent, $extensionFirstFile);
    $dataSecondFile = convertingFile($secondFileContent, $extensionSecondFile);
    $astTree = differenceCalculator($dataFirstFile, $dataSecondFile);
    return formatSelection($astTree, $formatter);
}

function differenceCalculator(object $dataFirstFile, object $dataSecondFile): array
{
    $data1 = get_object_vars($dataFirstFile);
    $data2 = get_object_vars($dataSecondFile);
    $mergeKeys = array_merge(array_keys($data1), array_keys($data2));
    $sortKeys = sort($mergeKeys, fn ($left, $right) => strcmp($left, $right));
    $orderedKeys = array_unique($sortKeys);
    return array_map(function ($key) use ($data1, $data2) {
        if (!array_key_exists($key, $data1)) {
            return ['key' => $key, 'data2Value' => $data2[$key], 'type' => 'added'];
        } elseif (!array_key_exists($key, $data2)) {
            return ['key' => $key, 'data1Value' => $data1[$key], 'type' => 'removed'];
        }
        if (is_object($data1[$key]) && is_object($data2[$key])) {
            $children = differenceCalculator($data1[$key], $data2[$key]);
            return ['key' => $key, 'type' => 'parent', 'children' => $children];
        }
        if ($data1[$key] === $data2[$key]) {
            return  ['key' => $key, 'data1Value' => $data1[$key], 'type' => 'unchanged'];
        } else {
            return ['key' => $key, 'data1Value' => $data1[$key], 'data2Value' => $data2[$key], 'type' => 'updated'];
        }
    }, $orderedKeys);
}
