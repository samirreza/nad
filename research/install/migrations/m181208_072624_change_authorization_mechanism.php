<?php

use yii\db\Migration;
use modules\nad\research\common\rules\ManageResearchRule;

class m181208_072624_change_authorization_mechanism extends Migration
{
    public function safeUp()
    {
        $authManager = Yii::$app->authManager;
        $authItems = [
            'research.manageSources',
            'research.manageProposals',
            'research.manageProject',
            'research.manageExperts',
            'research.createSource'
        ];
        foreach ($authItems as $authItem) {
            Yii::$app->db->createCommand()->delete(
                'auth_item',
                ['name' => $authItem]
            )->execute();
        }

        $authItem = 'research.manage';
        if (!$authManager->getPermission($authItem)) {
            $manageResearch = $authManager->createPermission($authItem);
            $manageResearch->description = 'مدیریت پژوهش';
            $authManager->add($manageResearch);
        }

        $manageResearchRule = new ManageResearchRule();
        $authManager->add($manageResearchRule);
        $manageOwnResearch = $authManager->createPermission('research.manageOwnResearch');
        $manageOwnResearch->description = 'مدیریت تحقیق خود';
        $manageOwnResearch->ruleName = $manageResearchRule->name;
        $authManager->add($manageOwnResearch);

        $expertRole = $authManager->getRole('expert');
        $authManager->addChild($expertRole, $manageOwnResearch);
    }

    public function safeDown()
    {
        echo "m181208_072624_change_authorization_mechanism cannot be reverted.\n";
        return false;
    }
}
