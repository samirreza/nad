<?php

use yii\db\Migration;

class m180428_052512_create_maker_equipment_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('nad_maker_equipment_relation', [
            'id' => $this->primaryKey(),
            'makerId' => $this->integer()->notNull(),
            'equipmentId' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'FK_maker_equipment_relation',
            'nad_maker_equipment_relation',
            'makerId',
            'nad_maker',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_equipment_maker_relation',
            'nad_maker_equipment_relation',
            'equipmentId',
            'nad_equipment_type',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }


    public function safeDown()
    {
        $this->dropForeignKey('FK_maker_equipment_relation');
        $this->dropForeignKey('FK_equipment_maker_relation');
        $this->dropTable('nad_maker_equipment_relation');
    }
}
