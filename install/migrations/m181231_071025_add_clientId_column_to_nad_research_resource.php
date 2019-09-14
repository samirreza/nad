<?php

use yii\db\Migration;

class m181231_071025_add_clientId_column_to_nad_research_resource extends Migration
{
    public function safeUp()
    {
        $this->addColumn(
            'nad_research_resource',
            'clientId',
            $this->string()->notNull()->defaultValue(0)
        );
    }

    public function safeDown()
    {
        echo "m181231_071025_add_clientId_column_to_nad_research_resource cannot be reverted.\n";
        return false;
    }
}
