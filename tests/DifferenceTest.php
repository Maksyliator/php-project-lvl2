<?php

namespace tests\test;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferenceTest extends TestCase
{
    /**
     * @dataProvider fixturesProvider
     */
    public function testGenDiff($firstPath, $secondPath, $expected, $style = 'stylish')
    {
        $this->assertEquals($expected, genDiff($firstPath, $secondPath, $style));
    }

    public function fixturesProvider(): array
    {
        $firstPathFlatJson = 'tests/fixtures/file1_flat_structure.json';
        $secondPathFlatJson = 'tests/fixtures/file2_flat_structure.json';

        $firstPathFlatYaml = 'tests/fixtures/file1_flat_structure.yaml';
        $secondPathFlatYml = 'tests/fixtures/file2_flat_structure.yml';

        $firstPathJson = 'tests/fixtures/file1_tree_structure.json';
        $secondPathJson = 'tests/fixtures/file2_tree_structure.json';

        $firstPathYaml = 'tests/fixtures/file1_tree_structure.yaml';
        $secondPathYaml = 'tests/fixtures/file2_tree_structure.yaml';

        $expectedStylishFlat = trim(file_get_contents($this->
        getFixtureFullPath('result_stylish_formatter_flat_structure')));
        $expectedStylish = trim(file_get_contents($this->
        getFixtureFullPath('result_stylish_formatter_tree_structure')));
        $expectedPlain = trim(file_get_contents($this->
        getFixtureFullPath('result_plain_formatter_tree_structure')));
        $expectedJson = trim(file_get_contents($this->
        getFixtureFullPath('result_json-formatter_tree_structure')));

        return [
            [$firstPathFlatJson, $secondPathFlatJson, $expectedStylishFlat],
            [$firstPathJson, $secondPathJson, $expectedStylish],
            [$firstPathJson, $secondPathJson, $expectedStylish, 'stylish'],
            [$firstPathJson, $secondPathJson, $expectedPlain , 'plain'],
            [$firstPathJson, $secondPathJson, $expectedJson, 'json'],
            [$firstPathFlatYaml, $secondPathFlatYml, $expectedStylishFlat],
            [$firstPathYaml, $secondPathYaml, $expectedStylish],
            [$firstPathYaml, $secondPathYaml, $expectedStylish, 'stylish'],
            [$firstPathYaml, $secondPathYaml, $expectedPlain, 'plain'],
            [$firstPathYaml, $secondPathYaml, $expectedJson, 'json']
        ];
    }

    public function getFixtureFullPath($fixtureName): string
    {
        $parts = [__DIR__, 'fixtures', $fixtureName];
        return realpath(implode('/', $parts));
    }
}
