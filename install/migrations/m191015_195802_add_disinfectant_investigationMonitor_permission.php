<?php

use yii\db\Migration;

/**
 * Class m191015_195802_add_disinfectant_investigationMonitor_permission
 */
class m191015_195802_add_disinfectant_investigationMonitor_permission extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $items = [
            'disinfectant.investigationMonitor' => 'بررسی پایش'
        ];

        foreach ($items as $item => $title) {
            if (!$auth->getPermission($item)) {
                $authItem = $auth->createPermission($item);
                $authItem->description = $title;
                $auth->add($authItem);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191015_195802_add_disinfectant_investigationMonitor_permission cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191015_195802_add_disinfectant_investigationMonitor_permission cannot be reverted.\n";

        return false;
    }
    */
}
