<?php

use yii\db\Migration;

class m181221_132948_create_nad_research_project_category_table extends Migration
{
    public function up()
    {
        $this->createTable('nad_research_project_category', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'tree' => $this->integer(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull()
        ]);
    }

    public function down()
    {
        $this->dropTable('nad_research_project_category');
    }
}
