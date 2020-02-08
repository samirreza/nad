<?php

use yii\db\Migration;

/**
 * Class m200208_025516_add_hydraulic_investigation_permission
 */
class m200208_025516_add_hydraulic_investigation_permission extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $items = [
            'hydraulic.investigation' => 'بررسی فرایندی'
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
        echo "m200208_025516_add_hydraulic_investigation_permission cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200208_025516_add_hydraulic_investigation_permission cannot be reverted.\n";

        return false;
    }
    */
}
