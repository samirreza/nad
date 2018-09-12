<?php

use yii\db\Migration;

class m180428_053255_rbac_migration_for_repairer extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $items = [
            'repairer.create' => 'ایجاد تعمیرکار',
            'repairer.delete' => 'حذف تعمیرکار',
            'repairer.update' => 'ویرایش تعمیرکار',
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
        echo "m180428_052212_rbac_migration_for_repairer cannot be reverted.\n";

        return false;
    }
}