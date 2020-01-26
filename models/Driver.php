<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "drivers".
 *
 * @property int $id
 * @property string $FIO ФИО
 * @property string $birthDate Дата рождения
 *
 * @property DriversToBus[] $driversToBuses
 */
class Driver extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'drivers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['FIO', 'birthDate'], 'required'],
            [['birthDate'], 'safe'],
            [['FIO'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'FIO' => 'Fio',
            'birthDate' => 'Birth Date',
        ];
    }

    /**
     * Gets query for [[DriversToBuses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDriversToBuses()
    {
        return $this->hasMany(DriverToBus::class, ['driverId' => 'id']);
    }

    public function getBuses()
    {
        return $this->hasMany(Bus::class, ['id' => 'busId'])->via('driversToBuses')->orderBy(['avgSpeed' => SORT_DESC]);

    }
}
