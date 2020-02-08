<?php

use yii\db\Migration;

/**
 * Class m200208_025700_add_hydraulic_investigationMonitor_permission
 */
class m200208_025700_add_hydraulic_investigationMonitor_permission extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $items = [
            'hydraulic.investigationMonitor' => 'بررسی پایش'
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
        echo "m200208_025700_add_hydraulic_investigationMonitor_permission cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200208_025700_add_hydraulic_investigationMonitor_permission cannot be reverted.\n";

        return false;
    }
    */
}
