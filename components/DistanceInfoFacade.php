<?php

namespace app\components;

use app\components\interfaces\DistanceCalculatorInterface;
use app\models\Bus;
use app\models\Driver;
use yii\base\BaseObject;

/**
 * Class DistanceInfoFacade
 *
 * Фасад для получения информации и водителях и продолжительности маршрута.
 */
class DistanceInfoFacade extends BaseObject
{
    /**
     * @var DistanceCalculatorInterface
     */
    private $distanceCalculatorService;

    /**
     * DistanceInfoFacade constructor.
     *
     * @param DistanceCalculatorInterface $distanceCalculatorService
     * @param array $config
     */
    public function __construct(DistanceCalculatorInterface $distanceCalculatorService, $config = [])
    {
        $this->distanceCalculatorService = $distanceCalculatorService;

        parent::__construct($config);
    }

    /**
     * Получение информации о видителях и продолжительности ммаршрута.
     *
     * @param string $startCity Начальный город.
     * @param string $endCity Конечный город.
     * @param int|null $driverId Идентификатор водителя.
     *
     * @return array
     */
    public function distanceInfo(string $startCity, string $endCity, ?int $driverId = null): array
    {
        $driversInfo = [];

        if ($driverId) {
            $driversModels[] = Driver::findOne($driverId);
        } else {
            $driversModels = Driver::find()->joinWith('buses')->orderBy(['avgSpeed' => SORT_DESC])->all();
        }

        $distance = $this->distanceCalculatorService->getDistanceBetweenCities($startCity, $endCity);

        $index = 0;
        /** @var Driver $driver */
        /** @var Bus $bus */
        foreach ($driversModels as $driver) {
            foreach ($driver->buses as $bus) {
                $driversInfo[$index]['id'] = $driver->id;
                $driversInfo[$index]['name'] = $driver->FIO;
                $driversInfo[$index]['birth_date'] = $driver->birthDate;
                $driversInfo[$index]['age'] = date("Y") - date("Y", strtotime($driver->birthDate));
                $driversInfo[$index]['bus_title'] = $bus->title;
                $driversInfo[$index]['travel_time'] = $this->getTimeToDrive($distance, $bus->avgSpeed);
                $index++;
            }
        }

        return $driversInfo;
    }

    /**
     * Получение количества дней в пути.
     *
     * @param int $distance Дистанция в километрах.
     * @param int $avgSpeed Средняя скорость в км/ч.
     * @param int $maxTimeDrivePerDay Максимальное время в пути в день, в часах.
     *
     * @return int
     */
    private function getTimeToDrive(int $distance, int $avgSpeed, int $maxTimeDrivePerDay = 8): int
    {
        return ceil($distance / $avgSpeed / $maxTimeDrivePerDay);
    }
}
