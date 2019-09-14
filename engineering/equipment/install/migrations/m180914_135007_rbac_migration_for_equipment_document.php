<?php

use yii\db\Migration;

class m180914_135007_rbac_migration_for_equipment_document extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $items = [
            'equipment.document' => 'مدیریت اسناد تجهیزات',
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
        echo "m180914_135007_rbac_migration_for_equipment_document cannot be reverted.\n";
        return false;
    }
}
