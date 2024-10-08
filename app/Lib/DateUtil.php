<?php

namespace App\Lib;

use DateTime;

class DateUtil
{
    /**
     * パラメータの年月日情報から日時文字列取得
     * 
     * 年,月,日から指定した日付文字列を返却
     * 月が1月より小さい場合は1月に補正/12月を超える場合は12月に補正
     * 日が1日より小さい場合は1日に補正/月末日を超える場合は月末日に補正
     * @param string $format
     * @param string | int $year
     * @param string | int $month
     * @param string | int $day
     * @return string $datetime
     */
    public static function paramToDateTimeString($format, $year, $month, $day)
    {
        return self::paramToDateTime($year, $month, $day)->format($format);
    }

    /**
     * パラメータの年月日情報からDateTime取得

     * 年,月,日から指定したDateTimeを返却
     * 月が1月より小さい場合は1月に補正/12月を超える場合は12月に補正
     * 日が1日より小さい場合は1日に補正/月末日を超える場合は月末日に補正
     * @param string | int $year
     * @param string | int $month
     * @param string | int $day
     * @return DateTime $datetime
     */
    public static function paramToDateTime($year, $month, $day)
    {
        $month = self::toValidMonth($month);
        $day = self::toValidDay($year, $month, $day);
        return DateTime::createFromFormat('Y-n-j', "{$year}-{$month}-{$day}");
    }

    private static function toValidMonth($month)
    {
        if ((int)$month > 12) {
            return 12;
        } elseif ((int)$month < 1) {
            return 1;
        } else {
            return $month;
        }
    }

    private static function toValidDay($year, $month, $day)
    {
        $lastDayOfMonth = DateTime::createFromFormat('Y-n-j', "{$year}-{$month}-1")->modify('last day of')->format('j');
        if ((int)$lastDayOfMonth < (int)$day) {
            return $lastDayOfMonth;
        } elseif ((int)$day < 1) {
            return 1;
        } else {
            return $day;
        }
    }
}
