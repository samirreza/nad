<?php

use yii\db\Migration;

class m181221_130753_add_code_uniqueCode_lastCode_column_to_nad_research_proposal extends Migration
{
    public function safeUp()
    {
        $this->addColumn(
            'nad_research_proposal',
            'code',
            $this->string()->notNull()
        );

        $this->addColumn(
            'nad_research_proposal',
            'uniqueCode',
            $this->string()->notNull()
        );

        $this->addColumn(
            'nad_research_proposal',
            'lastCode',
            $this->integer()->notNull()
        );
    }

    public function safeDown()
    {
        echo "m181221_130753_add_code_uniqueCode_lastCode_column_to_nad_research_proposal cannot be reverted.\n";
        return false;
    }
}
