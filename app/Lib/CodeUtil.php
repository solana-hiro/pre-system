<?php

namespace App\Lib;

class CodeUtil
{
    /**
     * Padding code
     * 
     * 指定桁数で前0パディングした結果を返す。
     * @param string $string
     * @param int $length
     * @return string the padding string
     */
    public static function pad(string $string, int $length): string
    {
        return str_pad($string, $length, 0, STR_PAD_LEFT);
    }
}
