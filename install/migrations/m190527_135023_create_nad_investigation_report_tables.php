<?php

use yii\db\Migration;

class m190527_135023_create_nad_investigation_report_tables extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('nad_investigation_report_category', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'tree' => $this->integer(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
            'consumer' => $this->string()->notNull()
        ]);

        $this->createTable('nad_investigation_report', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'englishTitle' => $this->string(),
            'createdAt' => $this->integer()->notNull(),
            'abstract' => $this->text()->notNull(),
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
            'proposalId' => $this->integer(),
            'categoryId' => $this->integer()->notNull()
        ], $tableOptions);

        $this->addForeignKey(
            'nad_investigation_report_proposalId',
            'nad_investigation_report',
            'proposalId',
            'nad_investigation_proposal',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->addForeignKey(
            'nad_investigation_report_categoryId',
            'nad_investigation_report',
            'categoryId',
            'nad_investigation_report_category',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        echo "m190527_135023_create_nad_investigation_report_tables cannot be reverted.\n";
        return false;
    }
}
