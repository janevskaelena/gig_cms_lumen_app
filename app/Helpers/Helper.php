<?php

namespace App\Helpers;


class Helper
{
    /**
     * Generate all combinations from given array of elements
     *
     * @param array $arElements
     * @return array
     */
    public static function generateAllCombinations(array $arElements): array {
        $arCombinations = [];
        for ($i = 0; $i < count($arElements); $i++) {
            $arCombinations = array_merge($arCombinations, self::generateCombinations($arElements, $i+1));
        }
        return $arCombinations;
    }

    /**
     * Generate combinations of given subset size from given array of elements
     *
     * @param array $arElements
     * @param int $subsetSize
     * @return array
     */
    public static function generateCombinations(array $arElements, int $subsetSize): array {
        /* @var \Math_Combinatorics $combinatorics */
        $combinatorics = new \Math_Combinatorics();
        return $combinatorics->combinations($arElements, $subsetSize);
    }

    /**
     * Generate string that is composed of the first letters of all the array elements given
     *
     * @param array $arWords
     * @return string
     * @throws \Exception
     */
    public static function generateAbbreviation (array $arWords): string {
        if(empty($arWords)){
            throw new \Exception('Empty array not allowed');
        }
        $abbreviation = '';
        foreach ($arWords as $word) {
            $abbreviation .= strtolower(substr($word, 0, 1));
        }
        return $abbreviation;
    }
}
