<?php

use yii\db\Migration;

class m190117_114104_change_some_foreign_keys extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey(
            'FK_nad_research_source_expert_relation_userId',
            'nad_research_source_expert_relation'
        );
        $this->dropColumn('nad_research_source_expert_relation', 'userId');
        $this->addColumn(
            'nad_research_source_expert_relation',
            'expertId',
            $this->integer()->notNull()
        );
        $this->addForeignKey(
            'FK_nad_research_source_expert_relation_expertId',
            'nad_research_source_expert_relation',
            'expertId',
            'nad_office_expert',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->dropForeignKey(
            'FK_nad_research_proposal_partner_relation_userId',
            'nad_research_proposal_partner_relation'
        );
        $this->dropColumn('nad_research_proposal_partner_relation', 'userId');
        $this->addColumn(
            'nad_research_proposal_partner_relation',
            'expertId',
            $this->integer()->notNull()
        );
        $this->addForeignKey(
            'FK_nad_research_proposal_partner_relation_expertId',
            'nad_research_proposal_partner_relation',
            'expertId',
            'nad_office_expert',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->renameColumn(
            'nad_research_proposal',
            'expertUserId',
            'projectExpertId'
        );
        $this->dropForeignKey(
            'FK_nad_research_proposal_user',
            'nad_research_proposal'
        );
        $this->addForeignKey(
            'FK_nad_research_proposal_projectExpertId',
            'nad_research_proposal',
            'projectExpertId',
            'nad_office_expert',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        echo "m190117_114104_change_some_foreign_keys cannot be reverted.\n";
        return false;
    }
}
