<?php

use yii\db\Migration;

class m190104_135053_create_equipment_sample_tables extends Migration
{
    public function safeUp()
    {
        $this->createTable('nad_equipment_sample', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'uniqueCode' => $this->string(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'categoryId' => $this->integer()->notNull(),
            'createdAt' => $this->integer(),
            'updatedAt' => $this->integer()
        ]);

        $this->createTable('nad_equipment_sample_category', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'tree' => $this->integer(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'FK_nad_equipment_sample_categoryId',
            'nad_equipment_sample',
            'categoryId',
            'nad_equipment_sample_category',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('nad_equipment_sample');
        $this->dropTable('nad_equipment_sample_category');
    }
}
