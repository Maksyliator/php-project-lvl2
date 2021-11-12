<?php

namespace Difference\Formatters;

use function Difference\Formatters\Stylish\makeStylishFormat;
use function Difference\Formatters\Plain\makePlainFormat;
use function Difference\Formatters\Json\makeJsonFormat;

function formatSelection(array $astTree, string $formatter = 'stylish'): string
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
