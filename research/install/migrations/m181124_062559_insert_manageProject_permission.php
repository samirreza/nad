<?php

use yii\db\Migration;

class m181124_062559_insert_manageProject_permission extends Migration
{
    public function safeUp()
    {
        $authManager = Yii::$app->authManager;
        $authItem = 'research.manageProject';
        if (!$authManager->getPermission($authItem)) {
            $manageProjectsPermission = $authManager->createPermission($authItem);
            $manageProjectsPermission->description = 'مدیریت پروژه های تحقیقاتی';
            $authManager->add($manageProjectsPermission);
        }
    }

    public function safeDown()
    {
        echo "m181124_062559_insert_manageProject_permission cannot be reverted.\n";
        return false;
    }
}
