<?php

use yii\db\Migration;

class m181122_135358_insert_source_permissions extends Migration
{
    public function safeUp()
    {
        $authManager = Yii::$app->authManager;
        $authItems = [
            'research.createSource' => 'درج منشا',
            'research.manageSource' => 'مدیریت منشا'
        ];
        foreach ($authItems as $authItem => $description) {
            if (!$authManager->getPermission($authItem)) {
                $permission = $authManager->createPermission($authItem);
                $permission->description = $description;
                $authManager->add($permission);
            }
        }
    }

    public function safeDown()
    {
        echo "m181122_135358_insert_source_permissions cannot be reverted.\n";
        return false;
    }
}
