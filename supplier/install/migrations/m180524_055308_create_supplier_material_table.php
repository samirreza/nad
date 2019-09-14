<?php

use yii\db\Migration;

class m180524_055308_create_supplier_material_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('nad_supplier_material_relation', [
            'id' => $this->primaryKey(),
            'supplierId' => $this->integer()->notNull(),
            'materialId' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'FK_supplier_relation',
            'nad_supplier_material_relation',
            'supplierId',
            'nad_supplier',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_material_relation',
            'nad_supplier_material_relation',
            'materialId',
            'nad_material_type',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }


    public function safeDown()
    {
        $this->dropForeignKey('FK_supplier_relation');
        $this->dropForeignKey('FK_material_relation');
        $this->dropTable('nad_supplier_material_relation');
    }
}
