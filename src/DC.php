<?php

namespace gen\diff;

function genDiff($file1, $file2)
{
    $file1Contents = file_get_contents("./$file1", true);
    $file2Contents = file_get_contents("./$file2", true);
    $data1 = json_decode($file1Contents, true);
    $data2 = json_decode($file2Contents, true);
    $keys = array_merge(array_keys($data1), array_keys($data2));
    $result = [];
    foreach ($keys as $key) {
        if (!array_key_exists($key, $data1)) {
            $result['+ '.$key] = $data2[$key];
        } elseif (!array_key_exists($key, $data2)) {
            $result['- '.$key] = $data1[$key];
        } elseif ($data1[$key] !== $data2[$key]) {
            $result['- '.$key] = $data1[$key];
            $result['+ '.$key] = $data2[$key];
        } else {
            $result[' '.$key] = $data2[$key];
        }
    }
    return json_encode($result, JSON_PRETTY_PRINT);
}
