<?php

use yii\db\Migration;

class m180428_052812_create_phonebook_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('nad_maker_phonebook', [
            'id' => $this->primaryKey(),
            'makerId' => $this->integer()->notNull(),
            'jobId' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'createdAt' => $this->integer()->notNull(),
            'updatedAt' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'FK_maker_phone',
            'nad_maker_phonebook',
            'makerId',
            'nad_maker',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_maker_job_phone',
            'nad_maker_phonebook',
            'jobId',
            'nad_maker_phonebook_jobs',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_maker_phone');
        $this->dropForeignKey('FK_maker_job_phone');
        $this->dropTable('nad_maker_phonebook');
    }
}
