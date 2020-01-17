<?php

use yii\db\Migration;

/**
 * Class m200117_165754_add_nad_engineering_piping_device_device_permission
 */
class m200117_165754_add_nad_engineering_piping_device_device_permission extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $items = [
            'device.device' => 'تجهیزات'
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
        echo "m200117_165754_add_nad_engineering_piping_device_device_permission cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200117_165754_add_nad_engineering_piping_device_device_permission cannot be reverted.\n";

        return false;
    }
    */
}
