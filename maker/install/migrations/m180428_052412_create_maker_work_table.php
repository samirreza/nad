<?php

use yii\db\Migration;

class m180428_052412_create_maker_work_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('nad_maker_work_type_relation', [
            'id' => $this->primaryKey(),
            'makerId' => $this->integer()->notNull(),
            'workId' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'FK_maker_relation',
            'nad_maker_work_type_relation',
            'makerId',
            'nad_maker',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_work_relation',
            'nad_maker_work_type_relation',
            'workId',
            'nad_maker_work_type',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }


    public function safeDown()
    {
        $this->dropForeignKey('FK_maker_relation');
        $this->dropForeignKey('FK_work_relation');
        $this->dropTable('maker_work_type_relation');
    }
}
