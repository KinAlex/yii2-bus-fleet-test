<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "driversToBuses".
 *
 * @property int $id
 * @property int $driverId
 * @property int $busId
 *
 * @property Bus $bus
 * @property Driver $driver
 */
class DriverToBus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'driversToBuses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['driverId', 'busId'], 'required'],
            [['driverId', 'busId'], 'integer'],
            [['busId'], 'exist', 'skipOnError' => true, 'targetClass' => Bus::className(), 'targetAttribute' => ['busId' => 'id']],
            [['driverId'], 'exist', 'skipOnError' => true, 'targetClass' => Driver::className(), 'targetAttribute' => ['driverId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'driverId' => 'Driver ID',
            'busId' => 'Bus ID',
        ];
    }

    /**
     * Gets query for [[Bus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBus()
    {
        return $this->hasOne(Bus::class, ['id' => 'busId']);
    }

    /**
     * Gets query for [[Driver]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDriver()
    {
        return $this->hasOne(Driver::class, ['id' => 'driverId']);
    }
}
