<?php

namespace App\Helpers;

class CurrencyHelper
{
    public static function formatCurrency($value)
    {
        $units = ['万', '億', '兆', '京', '垓', '秭', '穣', '溝', '澗', '正', '載', '極', '恒河沙', '阿僧祇', '那由他', '不可思議', '無量大数'];
        $unit = 10000;
        $index = 0;

        if ($value < $unit) {
            return $value.'万';
        }
        $num = $value;
        while ($num >= 1 && $index < count($units)) {
            $formatNum[] = mb_substr((string)$num, -4).$units[$index];
            $num /= $unit;
            $index++;
        }

        return implode('', array_reverse($formatNum));
    }
}
