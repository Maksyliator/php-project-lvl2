<?php

namespace Difference\Parsers;

use Symfony\Component\Yaml\Yaml;

function convertingFile(string $fileContent, string $extension): object
{
    switch ($extension) {
        case 'json':
            return json_decode($fileContent);
        case 'yaml' || 'yml':
            return Yaml::parse($fileContent, Yaml::PARSE_OBJECT_FOR_MAP);
    }
}
