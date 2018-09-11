<?php

use yii\db\Migration;

class m180428_053655_create_repairer_part_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('nad_repairer_part_relation', [
            'id' => $this->primaryKey(),
            'repairerId' => $this->integer()->notNull(),
            'partId' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'FK_repairer_part_relation',
            'nad_repairer_part_relation',
            'repairerId',
            'nad_repairer',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_part_repairer_relation',
            'nad_repairer_part_relation',
            'partId',
            'nad_equipment_type_part',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_repairer_part_relation');
        $this->dropForeignKey('FK_part_repairer_relation');
        $this->dropTable('nad_repairer_part_relation');
    }
}