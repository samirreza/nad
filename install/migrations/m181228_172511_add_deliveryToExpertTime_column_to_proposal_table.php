<?php

use yii\db\Migration;

class m181228_172511_add_deliveryToExpertTime_column_to_proposal_table extends Migration
{
    public function up()
    {
        $this->addColumn('nad_research_proposal', 'deliveryToExpertTime', $this->integer());
    }

    public function down()
    {
        echo "m181228_172511_add_deliveryToExpertTime_column_to_proposal_table cannot be reverted.\n";
        return false;
    }
}
