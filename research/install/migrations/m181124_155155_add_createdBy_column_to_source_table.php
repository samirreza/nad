<?php

use yii\db\Migration;

class m181124_155155_add_createdBy_column_to_source_table extends Migration
{
    public function up()
    {
        $this->addColumn(
            'nad_research_source',
            'createdBy',
            $this->integer()
        );

        $this->addForeignKey(
            'FK_nad_research_source_user',
            'nad_research_source',
            'createdBy',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropColumn('nad_research_source', 'createdBy');
    }
}
