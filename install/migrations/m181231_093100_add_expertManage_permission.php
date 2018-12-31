<?php

use yii\db\Migration;

class m181231_093100_add_expertManage_permission extends Migration
{
    public function safeUp()
    {
        $authManager = Yii::$app->authManager;
        $authItem = 'office.manageExpert';
        if (!$authManager->getPermission($authItem)) {
            $manageExpertPermission = $authManager->createPermission($authItem);
            $manageExpertPermission->description = 'مدیریت کارشناسان';
            $authManager->add($manageExpertPermission);
        }
    }

    public function safeDown()
    {
        echo "m181231_093100_add_expertManage_permission cannot be reverted.\n";
        return false;
    }
}
