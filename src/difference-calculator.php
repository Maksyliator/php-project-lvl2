<?php

namespace difference\calculator;

use function stylish\stylish;

function genDiff(object $data1, object $data2): string
{
    $result = [];
    if (is_object($data1) & is_object(($data2))) {
        $data1 = (array) $data1;
        $data2 = (array) $data2;
        $keys = array_merge(array_keys($data1), array_keys($data2));
        sort($keys);
        $keys = array_unique($keys);
        foreach ($keys as $key) {
            if (!array_key_exists($key, $data1)) {
                $result['+ ' . $key] = $data2[$key];
            } elseif (!array_key_exists($key, $data2)) {
                $result['- ' . $key] = $data1[$key];
            } elseif ($data1[$key] !== $data2[$key]) {
                $result['- ' . $key] = $data1[$key];
                $result['+ ' . $key] = $data2[$key];
            } else {
                $result['  ' . $key] = $data2[$key];
            }
        }
    }
    var_dump($result);
    return stylish($result);
}
