<?php

use yii\db\Migration;

/**
 * Class m200124_203321_create_table_buses
 */
class m200124_203321_create_table_buses extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('buses', [
            'id' => $this->primaryKey(),
            'title' => $this->string(100)->notNull()->comment('Марка - Модель - Год выпуска и тд'),
            'avgSpeed' => $this->smallInteger()->notNull()->comment('Средняя скорость движения'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('buses');
    }
}
