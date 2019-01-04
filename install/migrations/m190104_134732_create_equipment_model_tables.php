<?php

use yii\db\Migration;

class m190104_134732_create_equipment_model_tables extends Migration
{
    public function safeUp()
    {
        $this->createTable('nad_equipment_model', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'uniqueCode' => $this->string(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'categoryId' => $this->integer()->notNull(),
            'createdAt' => $this->integer(),
            'updatedAt' => $this->integer()
        ]);

        $this->createTable('nad_equipment_model_category', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'tree' => $this->integer(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'FK_nad_equipment_model_categoryId',
            'nad_equipment_model',
            'categoryId',
            'nad_equipment_model_category',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('nad_equipment_model');
        $this->dropTable('nad_equipment_model_category');
    }
}
