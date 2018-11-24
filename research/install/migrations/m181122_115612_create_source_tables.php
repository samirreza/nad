<?php

use yii\db\Migration;

class m181122_115612_create_source_tables extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions =
                'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('nad_research_source', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'recommenderName' => $this->string()->notNull(),
            'recommendationDate' => $this->integer()->notNull(),
            'reason' => $this->text()->notNull(),
            'necessity' => $this->text()->notNull(),
            'deliverToManagerDate' => $this->integer(),
            'sessionDate' => $this->integer(),
            'proceedings' => $this->text(),
            'expertId' => $this->integer(),
            'status' => $this->smallInteger()->notNull()->defaultValue(2),
            'documentationId' => $this->integer(),
            'createdAt' => $this->integer()->notNull(),
            'updatedAt' => $this->integer()->notNull()
        ], $tableOptions);

        $this->addForeignKey(
            'FK_nad_research_source_nad_research_expert',
            'nad_research_source',
            'expertId',
            'nad_research_expert',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->createTable('nad_research_source_reason', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()
        ], $tableOptions);

        $this->insertSourceReasons();

        $this->createTable('nad_research_source_reason_relation', [
            'id' => $this->primaryKey(),
            'sourceId' => $this->integer()->notNull(),
            'reasonId' => $this->integer()->notNull()
        ], $tableOptions);

        $this->addForeignKey(
            'FK_nad_research_source_reason_relation_sourceId',
            'nad_research_source_reason_relation',
            'sourceId',
            'nad_research_source',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_nad_research_source_reason_relation_reasonId',
            'nad_research_source_reason_relation',
            'reasonId',
            'nad_research_source_reason',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function insertSourceReasons()
    {
        $this->batchInsert(
            'nad_research_source_reason',
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
        $this->dropTable('nad_research_source_reason_relation');
        $this->dropTable('nad_research_source_reason');
        $this->dropTable('nad_research_source_document');
        $this->dropTable('nad_research_source');
    }
}
