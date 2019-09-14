<?php

use yii\db\Migration;

class m181228_151557_add_englishTitle_column_to_project_table extends Migration
{
    public function up()
    {
        $this->addColumn('nad_research_project', 'englishTitle', $this->string());
    }

    public function down()
    {
        echo "m181228_151557_add_englishTitle_column_to_project_table cannot be reverted.\n";
        return false;
    }
}
