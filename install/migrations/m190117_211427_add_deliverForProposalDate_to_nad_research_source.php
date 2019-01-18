<?php

use yii\db\Migration;

class m190117_211427_add_deliverForProposalDate_to_nad_research_source extends Migration
{
    public function safeUp()
    {
        $this->addColumn(
            'nad_research_source',
            'deliverForProposalDate',
            $this->integer()
        );
    }

    public function safeDown()
    {
        echo "m190117_211427_add_deliverForProposalDate_to_nad_research_source cannot be reverted.\n";
        return false;
    }
}
