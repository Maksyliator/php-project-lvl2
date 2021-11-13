<?php

namespace Differ\Formatters;

use function Differ\Formatters\Stylish\makeStylishFormat;
use function Differ\Formatters\Plain\makePlainFormat;
use function Differ\Formatters\Json\makeJsonFormat;

function formatSelection(array $astTree, string $formatter): string
{
    switch ($formatter) {
        case 'stylish':
            return makeStylishFormat($astTree);
        case 'plain':
            return makePlainFormat($astTree);
        case 'json':
            return makeJsonFormat($astTree);
    }
}
