<?php

namespace difference\calculator;

use function formatter\formatter;

function genDiff($data1, $data2): string
{
    if (is_object($data1) & is_object(($data2))) {
        $data1 = get_object_vars($data1);
        $data2 = get_object_vars($data2);
        $keys = array_merge(array_keys($data1), array_keys($data2));
        sort($keys);
        $result = [];
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
    return formatter($result);
}
