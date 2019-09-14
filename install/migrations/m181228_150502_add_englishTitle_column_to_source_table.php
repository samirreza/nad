<?php

use yii\db\Migration;

class m181228_150502_add_englishTitle_column_to_source_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('nad_research_source', 'englishTitle', $this->string());
    }

    public function safeDown()
    {
        echo "m181228_150502_add_columns_to_source_table cannot be reverted.\n";
        return false;
    }
}
