<?php

use yii\db\Migration;

class m180428_052612_create_maker_part_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('nad_maker_part_relation', [
            'id' => $this->primaryKey(),
            'makerId' => $this->integer()->notNull(),
            'partId' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'FK_maker_part_relation',
            'nad_maker_part_relation',
            'makerId',
            'nad_maker',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_part_maker_relation',
            'nad_maker_part_relation',
            'partId',
            'nad_equipment_type_part',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_maker_part_relation');
        $this->dropForeignKey('FK_part_maker_relation');
        $this->dropTable('nad_maker_part_relation');
    }
}