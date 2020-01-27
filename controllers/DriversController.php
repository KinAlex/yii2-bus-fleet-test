<?php

namespace app\controllers;

use app\components\DistanceInfoFacade;
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
     * @var DistanceInfoFacade
     */
    private $distanceInfoFacade;

    public function __construct($id, $module, DistanceInfoFacade $distanceInfoFacade, $config = [])
    {
        $this->distanceInfoFacade = $distanceInfoFacade;

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
        $distanceInfoArray = $this->distanceInfoFacade->distanceInfo($startCity, $endCity, $driverId);

        return $distanceInfoArray;
    }
}
