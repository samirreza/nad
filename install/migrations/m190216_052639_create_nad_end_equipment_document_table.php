<?php

use yii\db\Migration;

class m190216_052639_create_nad_end_equipment_document_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('nad_end_equipment_document', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'uniqueCode' => $this->string(),
            'description' => $this->text(),
            'archivesAddress' => $this->string(),
            'equipmentTypeId' => $this->integer()->notNull(),
            'createdAt' => $this->integer()->notNull(),
            'updatedAt' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'FK_nad_end_equipment_document_equipmentTypeId',
            'nad_end_equipment_document',
            'equipmentTypeId',
            'nad_equipment_type',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('nad_end_equipment_document');
    }
}
