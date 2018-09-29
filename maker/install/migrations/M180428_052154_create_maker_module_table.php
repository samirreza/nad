<?php

use yii\db\Migration;

class M180428_052154_create_maker_module_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('nad_maker', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'fame' => $this->string()->null(),
            'isLegal' => $this->boolean()->notNull(),
            'shopAddress' => $this->text()->notNull(),
            'factoryAddress' => $this->text()->null(),
            'phone' => $this->string()->notNull(),
            'fax' => $this->string()->null(),
            'mobile' => $this->string()->null(),
            'email' => $this->string()->null(),
            'website' => $this->string()->null(),
            'paymentType' => $this->integer()->notNull(),
            'description' => $this->text()->null(),
            'satisfaction' => $this->string()->null(),
            'isActive' => $this->boolean()->notNull()->defaultValue(1),
            'createdAt' => $this->integer()->notNull(),
            'updatedAt' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('nad_maker');
    }
}