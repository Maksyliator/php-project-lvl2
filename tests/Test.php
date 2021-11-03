<?php

namespace tests\test;

use PHPUnit\Framework\TestCase;
use function difference\calculator\genDiff;

class Test extends TestCase
{
    public function testGenDiff()
    {
        $expectedResult = file_get_contents(__DIR__ . '/../tests/fixtures/result', true);
        $file1Contents = file_get_contents('tests/fixtures/file1.json', true);
        $file2Contents = file_get_contents('tests/fixtures/file2.json', true);
        $this->assertEquals($expectedResult, genDiff(json_decode($file1Contents), json_decode($file2Contents)));
    }
}
