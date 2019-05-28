<?php

use yii\db\Migration;

class m190527_071714_add_pool_investigation_permission extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $items = [
            'pool.investigation' => 'بررسی'
        ];

        foreach ($items as $item => $title) {
            if (!$auth->getPermission($item)) {
                $authItem = $auth->createPermission($item);
                $authItem->description = $title;
                $auth->add($authItem);
            }
        }
    }

    public function safeDown()
    {
        echo "m190527_071714_add_pool_investigation_permission cannot be reverted.\n";
        return false;
    }
}
