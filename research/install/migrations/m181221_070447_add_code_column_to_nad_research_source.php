<?php

use yii\db\Migration;

class m181221_070447_add_code_column_to_nad_research_source extends Migration
{
    public function safeUp()
    {
        $this->addColumn(
            'nad_research_source',
            'code',
            $this->string()->notNull()
        );

        $this->addColumn(
            'nad_research_source',
            'uniqueCode',
            $this->string()->notNull()
        );

        $this->addColumn(
            'nad_research_source',
            'lastCode',
            $this->integer()->notNull()
        );
    }

    public function safeDown()
    {
        echo "m181221_070447_add_code_column_to_nad_research_source cannot be reverted.\n";
        return false;
    }
}
