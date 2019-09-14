<?php

use yii\db\Migration;

class m181228_171605_add_time_column_to_nad_research_source_expert_relation_table extends Migration
{
    public function up()
    {
        $this->addColumn('nad_research_source_expert_relation', 'time', $this->integer());
    }

    public function down()
    {
        echo "m181228_171605_add_time_column_to_nad_research_source_expert_relation_table cannot be reverted.\n";
        return false;
    }
}
