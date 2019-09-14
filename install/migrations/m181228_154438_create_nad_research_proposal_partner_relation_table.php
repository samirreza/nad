<?php

use yii\db\Migration;

class m181228_154438_create_nad_research_proposal_partner_relation_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions =
                'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('nad_research_proposal_partner_relation', [
            'id' => $this->primaryKey(),
            'proposalId' => $this->integer(),
            'userId' => $this->integer()
        ], $tableOptions);

        $this->addForeignKey(
            'FK_nad_research_proposal_partner_relation_proposalId',
            'nad_research_proposal_partner_relation',
            'proposalId',
            'nad_research_proposal',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_nad_research_proposal_partner_relation_userId',
            'nad_research_proposal_partner_relation',
            'userId',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('nad_research_proposal_partner_relation');
    }
}
