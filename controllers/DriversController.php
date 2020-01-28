<?php

namespace app\controllers;

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

    public function actions()
    {
        return array_merge(
            parent::actions(),
            [
                'distance-info' => [
                    'class' => 'app\actions\DistanceInfoAction',
                    'modelClass' => $this->modelClass,
                ]
            ]
        );
    }
}
