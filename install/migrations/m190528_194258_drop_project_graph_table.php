<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `nad_project_graph`.
 */
class m190528_194258_drop_project_graph_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('nad_project_graph');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190528_194258_drop_project_graph_table cannot be reverted.\n";
        return false;
    }
}
