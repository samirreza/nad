<?php

use yii\db\Migration;

class m180428_053455_create_repairer_work_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('nad_repairer_work_type_relation', [
            'id' => $this->primaryKey(),
            'repairerId' => $this->integer()->notNull(),
            'workId' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'FK_repairer_relation',
            'nad_repairer_work_type_relation',
            'repairerId',
            'nad_repairer',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_work_repairer_relation',
            'nad_repairer_work_type_relation',
            'workId',
            'nad_repairer_work_type',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }


    public function safeDown()
    {
        $this->dropForeignKey('FK_repairer_relation');
        $this->dropForeignKey('FK_work_repairer_relation');
        $this->dropTable('nad_repairer_work_type_relation');
    }
}