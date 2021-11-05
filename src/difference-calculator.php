<?php

namespace difference\calculator;

use function stylish\stylish;

function genDiff($data1, $data2, $formatter = 'stylish')
{
    $result = [];
    $data1 = (array) $data1;
    $data2 = (array) $data2;
    $keys = array_merge(array_keys($data1), array_keys($data2));
    sort($keys);
    $keys = array_unique($keys);
    foreach ($keys as $key) {
        if (array_key_exists($key, $data1)) {
            if (array_key_exists($key, $data2)) {
                if (!is_object($data1[$key]) & !is_object($data2[$key])) {
                    if ($data1[$key] !== $data2[$key]) {
                        $result['- ' . $key] = $data1[$key];
                        $result['+ ' . $key] = $data2[$key];
                    } else {
                        $result['  ' . $key] = $data2[$key];
                    }
                } else {
                    $data1 = (array) $data1[$key];
                    $data2 = (array) $data2[$key];
                    $result[$key] = array_map(
                        fn($data1, $data2) => genDiff($data1, $data2),
                        $data1,
                        $data2
                    );
                    return $result;
                }
            } else {
                $result['- ' . $key] = $data1[$key];
            }
        } else {
            $result['+ ' . $key] = $data2[$key];
        }
    }

    if ($formatter = 'stylish') {
        return stylish($result);
    }
    return $result;
}
