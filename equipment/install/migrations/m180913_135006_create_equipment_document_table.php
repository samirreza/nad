<?php

use yii\db\Migration;

class m180913_135006_create_equipment_document_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('nad_equipment_document', [
            'id' => $this->primaryKey(),
            'typeId' => $this->integer()->notNull(),
            'documentId' => $this->integer()->notNull(),
            'createdAt' => $this->integer()->notNull(),
            'updatedAt' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'FK_equipment_document',
            'nad_equipment_document',
            'typeId',
            'nad_equipment_type',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_document_type',
            'nad_equipment_document',
            'documentId',
            'nad_equipment_document_type',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_equipment_document');
        $this->dropForeignKey('FK_document_type');
        $this->dropTable('nad_equipment_document');
    }
}