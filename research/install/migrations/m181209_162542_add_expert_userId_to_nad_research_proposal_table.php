<?php

use yii\db\Migration;

class m181209_162542_add_expert_userId_to_nad_research_proposal_table extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey('FK_nad_research_proposal_nad_research_expert', 'nad_research_proposal');
        $this->dropColumn('nad_research_proposal', 'expertId');
        $this->addColumn(
            'nad_research_proposal',
            'expertUserId',
            $this->integer()
        );
        $this->addForeignKey(
            'FK_nad_research_proposal_user',
            'nad_research_proposal',
            'expertUserId',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        echo "m181209_162542_add_expert_userId_to_nad_research_proposal_table cannot be reverted.\n";
        return false;
    }
}
