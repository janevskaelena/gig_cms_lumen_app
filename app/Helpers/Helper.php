<?php

namespace App\Helpers;


class Helper
{
    public static function generateContents(array $arWords): array {
        $arPosts = [];
        $postCombinatorics = new \Math_Combinatorics();
        for ($i = 0; $i < count($arWords); $i++) {
            $arPosts = array_merge($arPosts, $postCombinatorics->combinations($arWords, $i+1));
        }
        return $arPosts;
    }

    public static function generateAbbreviation (array $arContent): string {
        $abbreviation = '';
        foreach ($arContent as $word) {
            $abbreviation .= strtolower(substr($word, 0, 1));
        }
        return $abbreviation;
    }
}
