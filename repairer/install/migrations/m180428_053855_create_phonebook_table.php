<?php

use yii\db\Migration;

class m180428_053855_create_phonebook_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('nad_repairer_phonebook', [
            'id' => $this->primaryKey(),
            'repairerId' => $this->integer()->notNull(),
            'jobId' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'createdAt' => $this->integer()->notNull(),
            'updatedAt' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'FK_repairer_phone',
            'nad_repairer_phonebook',
            'repairerId',
            'nad_repairer',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_repairer_job_phone',
            'nad_repairer_phonebook',
            'jobId',
            'nad_repairer_phonebook_jobs',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_repairer_phone');
        $this->dropForeignKey('FK_repairer_job_phone');
        $this->dropTable('nad_repairer_phonebook');
    }
}