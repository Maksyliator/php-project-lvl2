<?php

namespace Difference\Formatters\Json;

function makeJsonFormat(array $astTree): string
{
    return json_encode($astTree);
}
