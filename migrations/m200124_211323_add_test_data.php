<?php

use yii\db\Migration;

/**
 * Class m200124_211323_add_test_data
 */
class m200124_211323_add_test_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert(
            'drivers',
            [
                'FIO',
                'birthDate',
            ],
            [
                [
                    'Test1 Testov1 Testovich1',
                    '1987-01-23',
                ],
                [
                    'Test2 Testov2 Testovich2',
                    '1986-01-23',
                ],
                [
                    'Test3 Testov3 Testovich3',
                    '1985-01-23',
                ],
            ]
        );

        $this->batchInsert(
            'buses',
            [
                'title',
                'avgSpeed',
            ],
            [
                [
                    'bus1 - model1 - 2000',
                    '100',
                ],
                [
                    'bus1 - model2 - 2001',
                    '110',
                ],
                [
                    'bus2 - model1 - 2002',
                    '200',
                ],
            ]
        );

        $this->batchInsert(
            'driversToBuses',
            [
                'driverId',
                'busId',
            ],
            [
                [
                    '1',
                    '1',
                ],
                [
                    '2',
                    '2',
                ],
                [
                    '3',
                    '3',
                ],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200124_211323_add_test_data cannot be reverted.\n";

        return false;
    }
}
