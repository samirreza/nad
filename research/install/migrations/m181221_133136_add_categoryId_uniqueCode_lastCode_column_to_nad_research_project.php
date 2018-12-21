<?php

use yii\db\Migration;

class m181221_133136_add_categoryId_uniqueCode_lastCode_column_to_nad_research_project extends Migration
{
    public function safeUp()
    {
        $this->addColumn(
            'nad_research_project',
            'categoryId',
            $this->integer()->notNull()
        );

        $this->addForeignKey(
            'FK_nad_research_project_categoryId',
            'nad_research_project',
            'categoryId',
            'nad_research_project_category',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->addColumn(
            'nad_research_project',
            'uniqueCode',
            $this->string()->notNull()
        );

        $this->addColumn(
            'nad_research_project',
            'lastCode',
            $this->integer()->notNull()
        );
    }

    public function safeDown()
    {
        echo "m181221_133136_add_categoryId_uniqueCode_lastCode_column_to_nad_research_project cannot be reverted.\n";
        return false;
    }
}
