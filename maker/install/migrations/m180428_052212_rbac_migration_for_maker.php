<?php

use yii\db\Migration;

class m180428_052212_rbac_migration_for_maker extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $items = [
            'maker.create' => 'ایجاد سازنده',
            'maker.delete' => 'حذف سازنده',
            'maker.update' => 'ویرایش سازنده',
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
        echo "m180428_052212_rbac_migration_for_maker cannot be reverted.\n";

        return false;
    }
}