<?php

use yii\db\Migration;

class m181123_191640_create_proposal_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions =
                'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('nad_research_proposal', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'researcherName' => $this->string()->notNull(),
            'presentationDate' => $this->integer()->notNull(),
            'necessity' => $this->text()->notNull(),
            'mainPurpose' => $this->text()->notNull(),
            'secondaryPurpose' => $this->text()->notNull(),
            'deliverToManagerDate' => $this->integer(),
            'sessionDate' => $this->integer(),
            'proceedings' => $this->text(),
            'expertId' => $this->integer(),
            'status' => $this->smallInteger()->notNull()->defaultValue(2),
            'documentationId' => $this->integer(),
            'sourceId' => $this->integer(),
            'createdAt' => $this->integer()->notNull(),
            'updatedAt' => $this->integer()->notNull()
        ], $tableOptions);

        $this->addForeignKey(
            'FK_nad_research_proposal_nad_research_expert',
            'nad_research_proposal',
            'expertId',
            'nad_research_expert',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_nad_research_proposal_nad_research_source',
            'nad_research_proposal',
            'sourceId',
            'nad_research_source',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('nad_research_proposal');
    }
}
