<?php

use yii\db\Migration;

class m180913_135006_create_equipment_type_document_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('nad_equipment_type_document', [
            'id' => $this->primaryKey(),
            'equipmentTypeId' => $this->integer()->notNull(),
            'documentTypeId' => $this->integer()->notNull()
        ], $tableOptions);

        $this->addForeignKey(
            'FK_equipment_type_document_equipment_type',
            'nad_equipment_type_document',
            'equipmentTypeId',
            'nad_equipment_type',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_equipment_type_document_equipment_document_type',
            'nad_equipment_type_document',
            'documentTypeId',
            'nad_equipment_document_type',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('nad_equipment_type_document');
    }
}
