<?php

use yii\db\Migration;

class m181221_062323_add_mainReasonId_column_to_nad_research_source extends Migration
{
    public function safeUp()
    {
        $this->addColumn(
            'nad_research_source',
            'mainReasonId',
            $this->integer()->notNull()
        );

        $this->addForeignKey(
            'FK_nad_research_source_mainReasonId',
            'nad_research_source',
            'mainReasonId',
            'nad_research_source_reason',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        echo "m181221_062323_add_mainReasonId_column_to_nad_research_source cannot be reverted.\n";
        return false;
    }
}
