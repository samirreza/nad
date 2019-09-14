<?php

use yii\db\Migration;

class m190528_143725_create_nad_investigation_reference_tables extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions ='CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('nad_investigation_reference', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'type' => $this->string()->notNull(),
            'author' => $this->string(),
            'publisher' => $this->string(),
            'publishedYear' => $this->integer(),
            'description' => $this->text(),
            'createdAt' => $this->integer()->notNull(),
            'updatedAt' => $this->integer()->notNull(),
            'lastCodeNumber' => $this->integer()->notNull(),
            'uniqueCode' => $this->string()->notNull(),
            'consumer' => $this->string()->notNull(),
            'createdBy' => $this->integer()->notNull()
        ], $tableOptions);

        $this->createTable('nad_investigation_reference_relation', [
            'id' => $this->primaryKey(),
            'referenceId' => $this->integer(),
            'moduleId' => $this->string()->notNull(),
            'modelClassName' => $this->string()->notNull(),
            'modelId' => $this->integer()->notNull()
        ], $tableOptions);

        $this->addForeignKey(
            'FK_nad_investigation_reference_relation_referenceId',
            'nad_investigation_reference_relation',
            'referenceId',
            'nad_investigation_reference',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        echo "m190528_143725_create_nad_investigation_reference_tables cannot be reverted.\n";
        return false;
    }
}
