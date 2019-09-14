<?php

use yii\db\Migration;

class m180808_102145_create_equipment_type_table extends Migration
{
    public function up()
    {
        $this->createTable('nad_equipment_type', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'derivedCode' => $this->string(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'categoryId' => $this->integer()->notNull(),
            'createdAt' => $this->integer(),
            'updatedAt' => $this->integer()
        ]);

        $this->createTable('nad_equipment_type_category', [
            'id' => $this->primaryKey(),
            'code' => $this->string(),
            'title' => $this->string()->notNull()
        ]);

        $this->addForeignKey(
            'nad_equipment_type_FK1',
            'nad_equipment_type',
            'categoryId',
            'nad_equipment_type_category',
            'id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('nad_equipment_type');
        $this->dropTable('nad_equipment_type_category');
    }
}
