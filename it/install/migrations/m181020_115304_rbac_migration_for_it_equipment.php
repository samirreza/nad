<?php

use yii\db\Migration;

class m181020_115304_rbac_migration_for_it_equipment extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $items = [
            'it.equipment-type' => 'مدیریت انواع و رده های تحهیزات',
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
        echo "m181020_115304_rbac_migration_for_it_equipment cannot be reverted.\n";

        return false;
    }
}
