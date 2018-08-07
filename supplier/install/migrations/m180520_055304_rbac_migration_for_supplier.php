<?php

use yii\db\Migration;

class m180520_055304_rbac_migration_for_supplier extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $items = [
            'supplier.create' => 'ایجاد تامین کننده',
            'supplier.delete' => 'حذف تامین کننده',
            'supplier.update' => 'ویرایش تامین کننده',
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
        echo "m180520_055304_rbac_migration_for_supplier cannot be reverted.\n";

        return false;
    }
}