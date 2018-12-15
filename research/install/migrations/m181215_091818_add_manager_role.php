<?php

use yii\db\Migration;

class m181215_091818_add_manager_role extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        if (!$auth->getRole('manager')) {
            $expertRole = $auth->createRole('manager');
            $auth->add($expertRole);
        }
    }

    public function safeDown()
    {
        echo "m181215_091818_add_manager_role cannot be reverted.\n";
        return false;
    }
}
