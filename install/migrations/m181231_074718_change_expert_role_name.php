<?php

use yii\db\Migration;

class m181231_074718_change_expert_role_name extends Migration
{
    public function safeUp()
    {
        Yii::$app->db->createCommand("UPDATE auth_item
            SET name = 'research.expert'
            WHERE name = 'expert'")->execute();
    }

    public function safeDown()
    {
        echo "m181231_074718_change_expert_role_name cannot be reverted.\n";
        return false;
    }
}
