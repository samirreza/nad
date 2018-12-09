<?php

use yii\db\Migration;

class m181209_144326_create_nad_research_source_expert_relation_table extends Migration
{
    public function up()
    {
        $this->createTable('nad_research_source_expert_relation', [
            'id' => $this->primaryKey(),
            'userId' => $this->integer()->notNull(),
            'sourceId' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'FK_nad_research_source_expert_relation_userId',
            'nad_research_source_expert_relation',
            'userId',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_nad_research_source_expert_relation_sourceId',
            'nad_research_source_expert_relation',
            'sourceId',
            'nad_research_source',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('nad_research_source_expert_relation');
    }
}
