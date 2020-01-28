<?php

namespace app\actions;

use app\components\DistanceInfoFacade;
use yii\data\ArrayDataProvider;
use yii\data\BaseDataProvider;
use yii\rest\Action;

class DistanceInfoAction extends Action
{
    /**
     * @var DistanceInfoFacade
     */
    private $distanceInfoFacade;

    public function __construct($id, $controller, DistanceInfoFacade $distanceInfoFacade, $config = [])
    {
        $this->distanceInfoFacade = $distanceInfoFacade;

        parent::__construct($id, $controller, $config);
    }

    public function run(string $startCity, string $endCity, ?int $driverId = null): BaseDataProvider
    {
        $distanceInfoArray = $this->distanceInfoFacade->distanceInfo($startCity, $endCity, $driverId);

        return new ArrayDataProvider([
            'allModels' => $distanceInfoArray,
            'pagination' => [
                'pageSize' => 2,
            ],
        ]);
    }
}
