<?php

namespace gen\diff;

$file1 = file_get_contents('../file1.json');
$file2 = file_get_contents('../file2.json');
//print_r($file1);
//print_r($file2);

function genDiff($file1, $file2)
{
    $data1 = json_decode($file1, true);
    $data2 = json_decode($file2, true);
    $keys = array_merge(array_keys($data1), array_keys($data2));
    $result = [];
    foreach ($keys as $key) {
        if (!array_key_exists($key, $data1)) {
            $result["+ $key"] = $data2[$key];
        } elseif (!array_key_exists($key, $data2)) {
            $result["- $key"] = $data1[$key];
        } elseif ($data1[$key] !== $data2[$key]) {
            $result["- $key"] = $data1[$key];
            $result["+ $key"] = $data2[$key];
        } else {
            $result["  $key"] = $data2[$key];
        }
    }
    return json_encode($result, JSON_THROW_ON_ERROR);
}

print_r(genDiff($file1, $file2));
