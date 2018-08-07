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
        $this->createTable('nad_supplier_phonebook', [
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
            'nad_supplier_phonebook',
            'supplierId',
            'nad_supplier',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_job_phone',
            'nad_supplier_phonebook',
            'jobId',
            'nad_supplier_phonebook_jobs',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_supplier_phone');
        $this->dropForeignKey('FK_job_phone');
        $this->dropTable('nad_supplier_phonebook');
    }
}
