<?php

use yii\db\Migration;

class m181124_062019_create_project_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions =
                'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('nad_research_project', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'researcherName' => $this->string()->notNull(),
            'complationDate' => $this->integer()->notNull(),
            'abstract' => $this->text()->notNull(),
            'deliverToManagerDate' => $this->integer(),
            'sessionDate' => $this->integer(),
            'proceedings' => $this->text(),
            'status' => $this->smallInteger()->notNull()->defaultValue(2),
            'documentationId' => $this->integer(),
            'proposalId' => $this->integer(),
            'createdAt' => $this->integer()->notNull(),
            'updatedAt' => $this->integer()->notNull()
        ], $tableOptions);

        $this->addForeignKey(
            'FK_nad_research_project_nad_research_proposal',
            'nad_research_project',
            'proposalId',
            'nad_research_proposal',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('nad_research_project');
    }
}
