<?php

use yii\db\Migration;

/**
 * Class m200124_205009_create_table_drivers_to_buses
 */
class m200124_205009_create_table_drivers_to_buses extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('driversToBuses', [
            'id' => $this->primaryKey(),
            'driverId' => $this->integer()->notNull(),
            'busId' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-driversToBuses-driverId',
            'driversToBuses',
            'driverId',
            'drivers',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-driversToBuses-busId',
            'driversToBuses',
            'busId',
            'buses',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-driversToBuses-driverId', 'driversToBuses');

        $this->dropForeignKey('fk-driversToBuses-busId', 'driversToBuses');

        $this->dropTable('driversToBuses');
    }
}
