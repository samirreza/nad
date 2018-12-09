<?php

use yii\db\Migration;

class m181208_084743_drop_recommenderName_column extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('nad_research_source', 'recommenderName');
    }

    public function safeDown()
    {
        echo "m181208_084743_change_recommenderName_column cannot be reverted.\n";
        return false;
    }
}
