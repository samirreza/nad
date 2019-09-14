<?php

use yii\db\Migration;

class m181221_212145_create_eng_plant_tables extends Migration
{
    public function up()
    {
        $this->createTable('nad_eng_plant', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'uniqueCode' => $this->string(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'categoryId' => $this->integer()->notNull(),
            'createdAt' => $this->integer(),
            'updatedAt' => $this->integer()
        ]);

        $this->createTable('nad_eng_plant_category', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'tree' => $this->integer(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'nad_eng_plant_FK1',
            'nad_eng_plant',
            'categoryId',
            'nad_eng_plant_category',
            'id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('nad_eng_plant');
        $this->dropTable('nad_eng_plant_category');
    }
}
