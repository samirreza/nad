<?php

use yii\db\Migration;

class m181231_080447_change_nad_research_expert_schema extends Migration
{
    public function safeUp()
    {
        $this->renameTable('nad_research_expert', 'nad_office_expert');
        $this->addColumn(
            'nad_office_expert',
            'departmentId',
            $this->integer()->notNull()->defaultValue(0)
        );
    }

    public function safeDown()
    {
        echo "m181231_080447_change_nad_research_expert_schema cannot be reverted.\n";
        return false;
    }
}
