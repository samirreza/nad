<?php

use yii\db\Migration;

class m181209_143311_change_nad_research_proposal_schema extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('nad_research_proposal', 'researcherName');
        $this->addColumn(
            'nad_research_proposal',
            'createdBy',
            $this->integer()->notNull()
        );
        $this->addForeignKey(
            'FK_nad_research_proposal_createdBy',
            'nad_research_proposal',
            'createdBy',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->dropColumn('nad_research_proposal', 'presentationDate');

        $this->dropColumn('nad_research_source', 'recommendationDate');
    }

    public function safeDown()
    {
        echo "m181209_143311_change_researcher_column cannot be reverted.\n";
        return false;
    }
}
