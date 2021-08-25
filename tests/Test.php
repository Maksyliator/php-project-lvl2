<?php

namespace tests\test;

use PHPUnit\Framework\TestCase;
use function difference\calculator\genDiff;

class Test extends TestCase
{
    public function testMainFlow()
    {
        $fileContents = file_get_contents(__DIR__ . '/../tests/fixtures/result.json', true);
        $this->assertEquals($fileContents, genDiff('tests/fixtures/file1.json', 'tests/fixtures/file2.json'));
    }
}
