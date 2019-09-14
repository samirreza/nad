<?php

use yii\db\Migration;

class m180813_122145_create_material_type_tables extends Migration
{
    public function up()
    {
        $this->createTable('nad_material_type', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'derivedCode' => $this->string(),
            'title' => $this->string()->notNull(),
            'titleEn' => $this->string(),
            'description' => $this->text(),
            'categoryId' => $this->integer()->notNull(),
            'createdAt' => $this->integer(),
            'updatedAt' => $this->integer()
        ]);

        $this->createTable('nad_material_type_category', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'tree' => $this->integer(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'nad_material_type_FK1',
            'nad_material_type',
            'categoryId',
            'nad_material_type_category',
            'id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('nad_material_type');
        $this->dropTable('nad_material_type_category');
    }
}
