<?php

use yii\db\Migration;

/**
 * Handles the creation of table `nad_project_graph`.
 */
class m190527_134804_create_project_graph_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('nad_project_graph', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->notNull(),
            'child_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'nad_project_graph_FK1',
            'nad_project_graph',
            'parent_id',
            'nad_research_project',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'nad_project_graph_FK2',
            'nad_project_graph',
            'child_id',
            'nad_research_project',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'nad_project_graph_FK1',
            'nad_project_graph'
        );

        $this->dropForeignKey(
            'nad_project_graph_FK2',
            'nad_project_graph'
        );

        $this->dropTable('nad_project_graph');
    }
}
