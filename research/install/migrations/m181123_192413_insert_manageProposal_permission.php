<?php

use yii\db\Migration;

class m181123_192413_insert_manageProposal_permission extends Migration
{
    public function safeUp()
    {
        $authManager = Yii::$app->authManager;
        $authItem = 'research.manageProposals';
        if (!$authManager->getPermission($authItem)) {
            $manageProposalsPermission = $authManager->createPermission($authItem);
            $manageProposalsPermission->description = 'مدیریت پروپوزال ها';
            $authManager->add($manageProposalsPermission);
        }
    }

    public function safeDown()
    {
        echo "m181123_192413_insert_manageProposal_permission cannot be reverted.\n";
        return false;
    }
}
