<?php

use yii\db\Migration;

class m190113_162931_add_some_columns_to_nad_research_resource extends Migration
{
    public function safeUp()
    {
        $this->addColumn('nad_research_resource', 'publishYear', $this->integer());
        $this->addColumn('nad_research_resource', 'author', $this->string());
        $this->addColumn('nad_research_resource', 'publisher', $this->string());
    }

    public function safeDown()
    {
        echo "m190113_162931_add_some_columns_to_nad_research_resource cannot be reverted.\n";
        return false;
    }
}
