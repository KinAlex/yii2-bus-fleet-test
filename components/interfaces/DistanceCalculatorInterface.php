<?php

namespace app\components\interfaces;

use app\exceptions\InvalidCityPointsException;

/**
 * Interface DistanceCalculatorInterface
 */
interface DistanceCalculatorInterface
{
    /**
     * Полчуние расстояния между городами в километрах.
     *
     * @param string $startCityName Начальный город.
     * @param string $endCityName Конечный город.
     *
     * @return int Расстояние в километрах.
     *
     * @throws InvalidCityPointsException при невозможности расчитать расстояние.
     */
    public function getDistanceBetweenCities(string $startCityName, string $endCityName): int;
}
