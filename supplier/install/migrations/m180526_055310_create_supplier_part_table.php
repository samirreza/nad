<?php

use yii\db\Migration;

class m180526_055310_create_supplier_part_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('nad_supplier_part_relation', [
            'id' => $this->primaryKey(),
            'supplierId' => $this->integer()->notNull(),
            'partId' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'FK_supplier_part_relation',
            'nad_supplier_part_relation',
            'supplierId',
            'nad_supplier',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_part_relation',
            'nad_supplier_part_relation',
            'partId',
            'nad_equipment_type_part',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_supplier_part_relation');
        $this->dropForeignKey('FK_part_relation');
        $this->dropTable('nad_supplier_part_relation');
    }
}