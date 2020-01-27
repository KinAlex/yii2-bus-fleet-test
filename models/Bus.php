<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "buses".
 *
 * @property int $id
 * @property string $title Марка - Модель - Год выпуска и тд
 * @property int $avgSpeed Средняя скорость движения
 *
 * @property DriversToBus[] $driversToBuses
 */
class Bus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'buses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'avgSpeed'], 'required'],
            [['avgSpeed'], 'integer'],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'avgSpeed' => 'Avg Speed',
        ];
    }

    /**
     * Gets query for [[DriversToBuses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDriversToBuses()
    {
        return $this->hasMany(DriverToBus::class, ['busId' => 'id']);
    }
}
