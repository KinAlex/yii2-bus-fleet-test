<?php

namespace app\controllers;

use app\components\interfaces\DistanceCalculatorInterface;
use app\models\Bus;
use app\models\Driver;
use yii\db\ActiveRecord;
use yii\rest\ActiveController;

/**
 * Class DriversController
 *
 * REST контроллер для модели Driver.
 */
class DriversController extends ActiveController
{
    /**
     * @var ActiveRecord
     */
    public $modelClass = 'app\models\Driver';
    /**
     * @var DistanceCalculatorInterface
     */
    private $distanceCalculatorService;

    public function __construct($id, $module, DistanceCalculatorInterface $distanceCalculatorService, $config = [])
    {
        $this->distanceCalculatorService = $distanceCalculatorService;

        parent::__construct($id, $module, $config);
    }

    /**
     * Получение информации о видителях и продолжительности ммаршрута.
     *
     * @param string $startCity Начальный город.
     * @param string $endCity Конечный город.
     * @param int|null $driverId Идентификатор водителя.
     */
    public function actionDistanceInfo(string $startCity, string $endCity, ?int $driverId = null)
    {
        $driversModels = [];
        $driversInfo = [];

        if ($driverId) {
            $driversModels[] = $this->modelClass::findOne($driverId);
        } else {
            $driversModels = $this->modelClass::find()->joinWith('buses')->orderBy(['avgSpeed' => SORT_DESC])->all();
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
                $driversInfo[$index]['average_speed'] = $bus->avgSpeed;
                $driversInfo[$index]['travel_time'] = 12;
                $index++;
            }
        }

        return $driversInfo;
    }
}
