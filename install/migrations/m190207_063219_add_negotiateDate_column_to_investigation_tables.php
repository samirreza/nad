<?php

use yii\db\Migration;

class m190207_063219_add_negotiateDate_column_to_investigation_tables extends Migration
{
    public function safeUp()
    {
        $this->addColumn(
            'nad_research_source',
            'negotiateDate',
            $this->integer()
        );

        $this->addColumn(
            'nad_research_proposal',
            'negotiateDate',
            $this->integer()
        );

        $this->addColumn(
            'nad_research_project',
            'negotiateDate',
            $this->integer()
        );
    }

    public function safeDown()
    {
        echo "m190207_063219_add_negotiateDate_column_to_investigation_tables cannot be reverted.\n";
        return false;
    }
}
