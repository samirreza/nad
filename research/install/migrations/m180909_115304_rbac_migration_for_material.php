<?php

use yii\db\Migration;

class m180909_115304_rbac_migration_for_material extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $items = [
            'material.type' => 'مدیریت انواع و رده های مواد',
        ];

        foreach ($items as $item => $title) {
            if (null == $auth->getPermission($item)) {
                $authItem = $auth->createPermission($item);
                $authItem->description = $title;
                $auth->add($authItem);
            }
        }
    }

    public function safeDown()
    {
        echo "m180909_115304_rbac_migration_for_material cannot be reverted.\n";

        return false;
    }
}
