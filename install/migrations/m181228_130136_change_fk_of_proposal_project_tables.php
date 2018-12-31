<?php

use yii\db\Migration;

class m181228_130136_change_fk_of_proposal_project_tables extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey(
            'FK_nad_research_proposal_nad_research_source',
            'nad_research_proposal'
        );

        $this->addForeignKey(
            'FK_nad_research_proposal_sourceId',
            'nad_research_proposal',
            'sourceId',
            'nad_research_source',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->dropForeignKey(
            'FK_nad_research_project_nad_research_proposal',
            'nad_research_project'
        );

        $this->addForeignKey(
            'FK_nad_research_project_proposalId',
            'nad_research_project',
            'proposalId',
            'nad_research_proposal',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        echo "m181228_130136_change_fk_of_proposal_project_tables cannot be reverted.\n";
        return false;
    }
}
