<?php

use yii\db\Migration;
use nad\common\modules\investigation\common\rules\ManageInvestigationRule;

class m190527_052956_add_investigation_roles_and_permissions extends Migration
{
    public function safeUp()
    {
        $authItems = [
            'research.expert',
            'research.manage',
            'research.manageOwnResearch'
        ];
        foreach ($authItems as $authItem) {
            Yii::$app->db->createCommand()->delete(
                'auth_item',
                ['name' => $authItem]
            )->execute();
        }
        Yii::$app->db->createCommand()->delete(
            'auth_rule',
            ['name' => 'isResearchOwner']
        )->execute();

        $authManager = Yii::$app->authManager;
        if (!$authManager->getRole('expert')) {
            $expertRole = $authManager->createRole('expert');
            $authManager->add($expertRole);
        }

        $manageInvestigationRule = new ManageInvestigationRule();
        $authManager->add($manageInvestigationRule);
        $manageOwnInvestigation = $authManager->createPermission('investigation.manageOwnInvestigation');
        $manageOwnInvestigation->description = 'مدیریت تحقیق خود';
        $manageOwnInvestigation->ruleName = $manageInvestigationRule->name;
        $authManager->add($manageOwnInvestigation);

        $expertRole = $authManager->getRole('expert');
        $authManager->addChild($expertRole, $manageOwnInvestigation);
    }

    public function safeDown()
    {
        echo "m190527_052956_add_investigation_roles_and_permissions cannot be reverted.\n";
        return false;
    }
}
