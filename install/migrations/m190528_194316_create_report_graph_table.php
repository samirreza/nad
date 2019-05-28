<?php

use yii\db\Migration;

/**
 * Handles the creation of table `nad_report_graph`.
 */
class m190528_194316_create_report_graph_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('nad_report_graph', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->notNull(),
            'child_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'nad_report_graph_FK1',
            'nad_report_graph',
            'parent_id',
            'nad_investigation_report',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'nad_report_graph_FK2',
            'nad_report_graph',
            'child_id',
            'nad_investigation_report',
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
            'nad_report_graph_FK1',
            'nad_report_graph'
        );

        $this->dropForeignKey(
            'nad_report_graph_FK2',
            'nad_report_graph'
        );

        $this->dropTable('nad_report_graph');
    }
}
