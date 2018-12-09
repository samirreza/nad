<?php

use yii\db\Migration;

class m181209_181346_change_nad_research_project_table_schema extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('nad_research_project', 'researcherName');
        $this->dropColumn('nad_research_project', 'complationDate');
        $this->addColumn(
            'nad_research_project',
            'createdBy',
            $this->integer()->notNull()
        );
        $this->addForeignKey(
            'FK_nad_research_project_createdBy',
            'nad_research_project',
            'createdBy',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        echo "m181209_181346_change_nad_research_project_table_schema cannot be reverted.\n";
        return false;
    }
}
