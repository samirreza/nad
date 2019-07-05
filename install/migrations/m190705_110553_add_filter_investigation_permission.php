<?php

use yii\db\Migration;

class m190705_110553_add_filter_investigation_permission extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $items = [
            'filter.investigation' => 'بررسی'
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
        echo "m190705_110551_add_introduction_investigation_permission cannot be reverted.\n";
        return false;
    }
}