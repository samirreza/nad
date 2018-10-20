<?php

use yii\db\Migration;

class m181020_082145_create_it_equipment_type_tables extends Migration
{
    public function up()
    {
        $this->createTable('nad_it_equipment_type', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'uniqueCode' => $this->string(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'categoryId' => $this->integer()->notNull(),
            'createdAt' => $this->integer(),
            'updatedAt' => $this->integer()
        ]);

        $this->createTable('nad_it_equipment_type_category', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'tree' => $this->integer(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'nad_it_equipment_type_FK1',
            'nad_it_equipment_type',
            'categoryId',
            'nad_it_equipment_type_category',
            'id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('nad_it_equipment_type');
        $this->dropTable('nad_it_equipment_type_category');
    }
}
