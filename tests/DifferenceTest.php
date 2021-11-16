<?php

namespace tests\test;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferenceTest extends TestCase
{
    public const PATHTOFIRSTJSONFILES = 'tests/fixtures/file1_tree_structure.json';
    public const PATHTOSECONDJSONFILES = 'tests/fixtures/file2_tree_structure.json';
    public const PATHTOFIRSTYAMLFILES = 'tests/fixtures/file1_tree_structure.yaml';
    public const PATHTOSECONDYAMLFILES = 'tests/fixtures/file2_tree_structure.yaml';

    /**
     * @dataProvider argumentProviderForFlatStructure
     * @dataProvider argumentProviderForTreeStructureStylishFormat
     * @dataProvider argumentProviderForFlatStructure
     * @dataProvider argumentProviderForTreeStructureJsonFormat
     */
    public function testGenDiff($firstPath, $secondPath, $expected, $style = 'stylish')
    {
        $this->assertEquals($expected, genDiff($firstPath, $secondPath, $style));
    }

    public function argumentProviderForFlatStructure(): array
    {
        $firstPathFlatJson = 'tests/fixtures/file1_flat_structure.json';
        $secondPathFlatJson = 'tests/fixtures/file2_flat_structure.json';

        $firstPathFlatYaml = 'tests/fixtures/file1_flat_structure.yaml';
        $secondPathFlatYml = 'tests/fixtures/file2_flat_structure.yml';

        $expectedStylishFlat = trim(file_get_contents($this->
        getFixtureFullPath('result_stylish_formatter_flat_structure')));

        return [
            [$firstPathFlatJson, $secondPathFlatJson, $expectedStylishFlat],
            [$firstPathFlatYaml, $secondPathFlatYml, $expectedStylishFlat]
        ];
    }

    public function argumentProviderForTreeStructureStylishFormat(): array
    {
        $expectedStylish = trim(file_get_contents($this->
        getFixtureFullPath('result_stylish_formatter_tree_structure')));

        return [
            [self::PATHTOFIRSTJSONFILES, self::PATHTOSECONDJSONFILES, $expectedStylish],
            [self::PATHTOFIRSTJSONFILES, self::PATHTOSECONDJSONFILES, $expectedStylish, 'stylish'],
            [self::PATHTOFIRSTYAMLFILES, self::PATHTOSECONDYAMLFILES, $expectedStylish],
            [self::PATHTOFIRSTYAMLFILES, self::PATHTOSECONDYAMLFILES, $expectedStylish, 'stylish']
        ];
    }

    public function argumentProviderForTreeStructurePlainFormat(): array
    {
        $expectedPlain = trim(file_get_contents($this->
        getFixtureFullPath('result_plain_formatter_tree_structure')));

        return [
            [self::PATHTOFIRSTJSONFILES, self::PATHTOSECONDJSONFILES, $expectedPlain , 'plain'],
            [self::PATHTOFIRSTYAMLFILES, self::PATHTOSECONDYAMLFILES, $expectedPlain, 'plain']
        ];
    }

    public function argumentProviderForTreeStructureJsonFormat(): array
    {
        $expectedJson = trim(file_get_contents($this->
        getFixtureFullPath('result_json-formatter_tree_structure')));

        return [
            [self::PATHTOFIRSTJSONFILES, self::PATHTOSECONDJSONFILES, $expectedJson, 'json'],
            [self::PATHTOFIRSTYAMLFILES, self::PATHTOSECONDYAMLFILES, $expectedJson, 'json']
        ];
    }

    public function getFixtureFullPath($fixtureName): string
    {
        $parts = [__DIR__, 'fixtures', $fixtureName];
        return realpath(implode('/', $parts));
    }
}
