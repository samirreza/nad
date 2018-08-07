<?php

use yii\db\Migration;

class m180428_053001_create_phonebook_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('phonebook', [
            'id' => $this->primaryKey(),
            'supplierId' => $this->integer()->notNull(),
            'jobId' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'createdAt' => $this->integer()->notNull(),
            'updatedAt' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'FK_supplier_phone',
            'phonebook',
            'supplierId',
            'supplier',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_job_phone',
            'phonebook',
            'jobId',
            'jobs',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('phonebook');
        $this->dropForeignKey('FK_supplier_phone');
        $this->dropForeignKey('FK_job_phone');
    }
}