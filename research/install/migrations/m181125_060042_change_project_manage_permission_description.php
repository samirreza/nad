<?php

use yii\db\Migration;

class m181125_060042_change_project_manage_permission_description extends Migration
{
    public function safeUp()
    {
        Yii::$app->db->createCommand()->update(
            'auth_item',
            ['description' => 'مدیریت گزارش ها'],
            ['name' => 'research.manageProject']
        )->execute();
    }

    public function safeDown()
    {
        echo "m181125_060042_change_project_manage_permission_description cannot be reverted.\n";
        return false;
    }
}
