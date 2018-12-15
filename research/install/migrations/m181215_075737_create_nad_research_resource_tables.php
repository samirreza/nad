<?php

use yii\db\Migration;

class m181215_075737_create_nad_research_resource_tables extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions =
                'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('nad_research_resource', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'createdAt' => $this->integer()->notNull(),
            'updatedAt' => $this->integer()->notNull()
        ], $tableOptions);

        $this->createTable('nad_research_resource_relation', [
            'id' => $this->primaryKey(),
            'resourceId' => $this->integer(),
            'modelClassName' => $this->string(),
            'modelId' => $this->integer()
        ], $tableOptions);

        $this->addForeignKey(
            'FK_nad_research_resource_relation_resourceId',
            'nad_research_resource_relation',
            'resourceId',
            'nad_research_resource',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('nad_research_resource_relation');
        $this->dropTable('nad_research_resource');
    }
}
