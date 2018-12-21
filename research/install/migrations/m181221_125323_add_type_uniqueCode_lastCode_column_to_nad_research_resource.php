<?php

use yii\db\Migration;

class m181221_125323_add_type_uniqueCode_lastCode_column_to_nad_research_resource extends Migration
{
    public function safeUp()
    {
        $this->addColumn(
            'nad_research_resource',
            'type',
            $this->string()->notNull()
        );

        $this->addColumn(
            'nad_research_resource',
            'uniqueCode',
            $this->string()->notNull()
        );

        $this->addColumn(
            'nad_research_resource',
            'lastCode',
            $this->integer()->notNull()
        );
    }

    public function safeDown()
    {
        echo "m181221_125323_add_type_uniqueCode_lastCode_column_to_nad_research_resource cannot be reverted.\n";
        return false;
    }
}
