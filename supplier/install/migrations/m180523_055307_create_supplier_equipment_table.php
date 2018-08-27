<?php

use yii\db\Migration;

class m180523_055307_create_supplier_equipment_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('nad_supplier_equipment_relation', [
            'id' => $this->primaryKey(),
            'supplierId' => $this->integer()->notNull(),
            'equipmentId' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'FK_supplier_elation',
            'nad_supplier_equipment_relation',
            'supplierId',
            'nad_supplier',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_equipment_relation',
            'nad_supplier_equipment_relation',
            'equipmentId',
            'nad_equipment_type',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }


    public function safeDown()
    {
        $this->dropForeignKey('FK_supplier_elation');
        $this->dropForeignKey('FK_equipment_relation');
        $this->dropTable('nad_supplier_equipment_relation');
    }
}
