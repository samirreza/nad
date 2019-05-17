<?php

use yii\db\Migration;

class m190514_052652_create_nad_investigation_source_tables extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions =
                'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('nad_investigation_source', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'englishTitle' => $this->string(),
            'createdAt' => $this->integer()->notNull(),
            'reasonForGenesis' => $this->text()->notNull(),
            'necessity' => $this->text()->notNull(),
            'description' => $this->text(),
            'mainReasonId' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'createdBy' => $this->integer()->notNull(),
            'updatedAt' => $this->integer()->notNull(),
            'deliverToManagerDate' => $this->integer(),
            'sessionDate' => $this->integer(),
            'proceedings' => $this->text(),
            'negotiationResult' => $this->text(),
            'lastCodeNumber' => $this->integer()->notNull(),
            'uniqueCode' => $this->string()->notNull(),
            'consumer' => $this->string()->notNull()
        ], $tableOptions);

        $this->createTable('nad_investigation_source_reason', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()
        ], $tableOptions);

        $this->insertSourceReasons();

        $this->createTable('nad_investigation_source_reason_relation', [
            'id' => $this->primaryKey(),
            'sourceId' => $this->integer()->notNull(),
            'reasonId' => $this->integer()->notNull()
        ], $tableOptions);

        $this->addForeignKey(
            'FK_nad_investigation_source_reason_relation_sourceId',
            'nad_investigation_source_reason_relation',
            'sourceId',
            'nad_investigation_source',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_nad_investigation_source_reason_relation_reasonId',
            'nad_investigation_source_reason_relation',
            'reasonId',
            'nad_investigation_source_reason',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createTable('nad_investigation_source_expert_relation', [
            'id' => $this->primaryKey(),
            'expertId' => $this->integer()->notNull(),
            'sourceId' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'FK_nad_investigation_source_expert_relation_expertId',
            'nad_investigation_source_expert_relation',
            'expertId',
            'nad_office_expert',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_nad_investigation_source_expert_relation_sourceId',
            'nad_investigation_source_expert_relation',
            'sourceId',
            'nad_investigation_source',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function insertSourceReasons()
    {
        $this->batchInsert(
            'nad_investigation_source_reason',
            ['title'],
            [
                ['title' => 'ایده'],
                ['title' => 'سوال'],
                ['title' => 'تجربه'],
                ['title' => 'گزارش'],
                ['title' => 'مشکلات'],
                ['title' => 'غیره']
            ]
        );
    }

    public function safeDown()
    {
        echo "m190514_052652_create_nad_investigation_tables cannot be reverted.\n";
        return false;
    }
}
