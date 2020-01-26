<?php

namespace app\components\helpers;

/**
 * Class DistanceHelper
 */
class DistanceHelper
{
    /**
     * Получение количества дней в пути.
     *
     * @param int $distance Дистанция в километрах.
     * @param int $avgSpeed Средняя скорость в км/ч.
     * @param int $maxTimeDrivePerDay Максимальное время в пути в день, в часах.
     *
     * @return int
     */
    public static function getTimeToDrive(int $distance, int $avgSpeed, int $maxTimeDrivePerDay = 8): int
    {

    }
}
