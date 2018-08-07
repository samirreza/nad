<?php

use yii\db\Migration;

class m180428_052143_create_supplier_module_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('nad_supplier', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'isForeign' => $this->boolean()->notNull(),
            'type' => $this->string()->notNull(),
            'email' => $this->string()->null(),
            'website' => $this->string()->null(),
            'shopAddress' => $this->text()->notNull(),
            'factoryAddress' => $this->text()->notNull(),
            'paymentType' => $this->integer()->notNull(),
            'description' => $this->text()->null(),
            'createdAt' => $this->integer()->notNull(),
            'updatedAt' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('nad_supplier');
    }
}
