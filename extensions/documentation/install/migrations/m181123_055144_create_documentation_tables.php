<?php

use yii\db\Migration;

class m181123_055144_create_documentation_tables extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('module_documentation', [
            'id' => $this->primaryKey(),
            'modelClassName' => $this->string()->notNull()
        ], $tableOptions);

        $this->createTable('module_documentation_file', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'description' => $this->text(),
            'documentationId' => $this->integer()->notNull(),
            'createdAt' => $this->integer()->notNull(),
            'updatedAt' => $this->integer()->notNull()
        ], $tableOptions);

        $this->addForeignKey(
            'FK_module_documentation_file_documentationId',
            'module_documentation_file',
            'documentationId',
            'module_documentation',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('module_documentation_file');
        $this->dropTable('module_documentation');
    }
}
