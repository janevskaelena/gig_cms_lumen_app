<?php

use \App\Helpers\Helper;

class HelperTest extends TestCase
{

    /**
     * test generateAbbreviation
     * @throws Exception
     */
    public function testGenerateAbbreviation()
    {
        $result = Helper::generateAbbreviation(['alpha', 'beta', 'gama']);
        $this->assertEquals('abg', $result);

        $result = Helper::generateAbbreviation(['a', 'm', 't']);
        $this->assertEquals('amt', $result);

        $result = Helper::generateAbbreviation(['A', 'm', 't']);
        $this->assertEquals('amt', $result);

        $result = Helper::generateAbbreviation(['A', 'm', ''], false);
        $this->assertEquals('Am', $result);

        $result = Helper::generateAbbreviation(['','']);
        $this->assertEquals('', $result);


        $this->expectException(\Exception::class);
        Helper::generateAbbreviation([]);

        $this->expectException(\TypeError::class);
        Helper::generateAbbreviation(null);
    }

    /**
     * Test generateCombinations
     * @throws Exception
     */
    public function testGenerateCombinations () {
        $result = Helper::generateCombinations(['alpha', 'beta', 'gama'], 3);

        $this->assertIsArray($result);
        $this->assertJsonStringEqualsJsonString(json_encode([['alpha', 'beta', 'gama']]), json_encode($result));

        $result = Helper::generateCombinations(['alpha', 'beta', 'gama'], 1);
        $this->assertJsonStringEqualsJsonString(json_encode([['alpha'], ['beta'], ['gama']]), json_encode($result));

        $this->expectException(\Exception::class);
        Helper::generateCombinations(['alpha','beta', 'gama'], 0);

        $this->expectException(\Exception::class);
        Helper::generateCombinations(['alpha','beta', 'gama'], 4);

        $this->expectException(\TypeError::class);
        Helper::generateCombinations([], null);

        $this->expectException(\TypeError::class);
        Helper::generateCombinations(null, null);

        $this->expectException(\TypeError::class);
        Helper::generateCombinations(null, '4');
    }

    /**
     * Test generateAllCombinations
     */
    public function testGenerateAllCombinations () {
        $result = Helper::generateAllCombinations(['alpha', 'beta', 'gama']);

        $this->assertIsArray($result);
        $flattenExpected = array_merge(...array_values([
            ['alpha'],
            ['beta'],
            ['gama'],
            ['alpha', 'beta'],
            ['alpha', 'gama'],
            ['beta', 'gama'],
            ['alpha', 'beta', 'gama']
        ]));
        $flattenResult = array_merge(...array_values($result));
        $this->assertJsonStringEqualsJsonString(json_encode($flattenExpected), json_encode($flattenResult));

        $result = Helper::generateAllCombinations([]);
        $this->assertEmpty($result);

        $this->expectException(\TypeError::class);
        Helper::generateAllCombinations(null);

    }
}
