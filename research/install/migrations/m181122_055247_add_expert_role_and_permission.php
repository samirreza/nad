<?php

use yii\db\Migration;

class m181122_055247_add_expert_role_and_permission extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        if (!$auth->getRole($role)) {
            $expertRole = $auth->createRole('expert');
            $auth->add($expertRole);
        }

        $authItem = 'research.manageExperts';
        if (!$auth->getPermission($authItem)) {
            $manageExpertsPermission = $auth->createPermission($authItem);
            $manageExpertsPermission->description = 'مدیریت کارشناسان';
            $auth->add($manageExpertsPermission);
        }
    }

    public function safeDown()
    {
        echo "m181122_055247_add_expert_role_and_permission cannot be reverted.\n";
        return false;
    }
}
