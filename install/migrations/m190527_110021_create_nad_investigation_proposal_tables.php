<?php

use yii\db\Migration;

class m190527_110021_create_nad_investigation_proposal_tables extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('nad_investigation_proposal', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'englishTitle' => $this->string(),
            'createdAt' => $this->integer()->notNull(),
            'reasonForGenesis' => $this->text()->notNull(),
            'necessity' => $this->text()->notNull(),
            'description' => $this->text(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'createdBy' => $this->integer()->notNull(),
            'updatedAt' => $this->integer()->notNull(),
            'deliverToManagerDate' => $this->integer(),
            'sessionDate' => $this->integer(),
            'proceedings' => $this->text(),
            'negotiationResult' => $this->text(),
            'lastCodeNumber' => $this->integer()->notNull(),
            'uniqueCode' => $this->string()->notNull(),
            'consumer' => $this->string()->notNull(),
            'sourceId' => $this->integer(),
            'reportExpertId' => $this->integer()
        ], $tableOptions);

        $this->addForeignKey(
            'nad_investigation_proposal_sourceId',
            'nad_investigation_proposal',
            'sourceId',
            'nad_investigation_source',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->addForeignKey(
            'nad_investigation_proposal_reportExpertId',
            'nad_investigation_proposal',
            'reportExpertId',
            'nad_office_expert',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->createTable('nad_investigation_proposal_partner_relation', [
            'id' => $this->primaryKey(),
            'proposalId' => $this->integer()->notNull(),
            'expertId' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'nad_investigation_proposal_partner_relation_proposalId',
            'nad_investigation_proposal_partner_relation',
            'proposalId',
            'nad_investigation_proposal',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'nad_investigation_proposal_partner_relation_expertId',
            'nad_investigation_proposal_partner_relation',
            'expertId',
            'nad_office_expert',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        echo "m190527_110021_create_nad_investigation_proposal_tables cannot be reverted.\n";
        return false;
    }
}
