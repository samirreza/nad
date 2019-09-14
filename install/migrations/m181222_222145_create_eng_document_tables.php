<?php

use yii\db\Migration;

class m181222_222145_create_eng_document_tables extends Migration
{
    public function up()
    {
        $this->createTable('nad_eng_document', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'uniqueCode' => $this->string(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'categoryId' => $this->integer()->notNull(),
            'createdAt' => $this->integer(),
            'updatedAt' => $this->integer()
        ]);

        $this->createTable('nad_eng_document_category', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'tree' => $this->integer(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'nad_eng_document_FK1',
            'nad_eng_document',
            'categoryId',
            'nad_eng_document_category',
            'id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('nad_eng_document');
        $this->dropTable('nad_eng_document_category');
    }
}
