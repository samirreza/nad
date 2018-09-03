<?php

use yii\db\Migration;

class m180525_055309_alter_factoryAddress_in_supplier_table extends Migration
{
    public function up()
    {
        $this->alterColumn(
            'nad_supplier',
            'factoryAddress',
            $this->text()->null()
        );
    }

    public function safeDown()
    {
        echo "m180525_055309_alter_factoryAddress_in_supplier_table cannot be reverted.\n";
        return false;
    }
}