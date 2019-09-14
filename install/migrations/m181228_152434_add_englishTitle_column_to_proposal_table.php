<?php

use yii\db\Migration;

class m181228_152434_add_englishTitle_column_to_proposal_table extends Migration
{
    public function up()
    {
        $this->addColumn('nad_research_proposal', 'englishTitle', $this->string());
    }

    public function down()
    {
        echo "m181228_152434_add_englishTitle_column_to_proposal_table cannot be reverted.\n";
        return false;
    }
}
