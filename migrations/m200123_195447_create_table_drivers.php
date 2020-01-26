<?php

use yii\db\Migration;
use \yii\db\Schema;

/**
 * Class m200123_195447_create_table_drivers
 */
class m200123_195447_create_table_drivers extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('drivers', [
            'id' => $this->primaryKey(),
            'FIO' => $this->string(50)->notNull()->comment('ФИО'),
            'birthDate' => $this->date()->notNull()->comment('Дата рождения'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('drivers');
    }
}
