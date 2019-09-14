<?php

use yii\db\Migration;

class m181223_143916_add_tree_column_to_nad_research_project extends Migration
{
    public function safeUp()
    {
        $this->addColumn(
            'nad_research_project',
            'tree',
            $this->integer()
        );

        $this->addColumn(
            'nad_research_project',
            'lft',
            $this->integer()->notNull()->defaultValue(1)
        );

        $this->addColumn(
            'nad_research_project',
            'rgt',
            $this->integer()->notNull()->defaultValue(2)
        );

        $this->addColumn(
            'nad_research_project',
            'depth',
            $this->integer()->notNull()->defaultValue(0)
        );
    }

    public function safeDown()
    {
        echo "m181223_143916_add_tree_column_to_nad_research_project cannot be reverted.\n";
        return false;
    }
}
