<?php

use yii\db\Migration;

class m180909_120304_rbac_migration_for_equipment extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $items = [
            'equipment.type' => 'مدیریت انواع و رده های تجهیزات',
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
        echo "m180909_120304_rbac_migration_for_equipment cannot be reverted.\n";

        return false;
    }
}
