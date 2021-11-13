<?php

namespace Differ\Formatters\Json;

function makeJsonFormat(array $astTree): string
{
    return json_encode($astTree, JSON_THROW_ON_ERROR);
}
