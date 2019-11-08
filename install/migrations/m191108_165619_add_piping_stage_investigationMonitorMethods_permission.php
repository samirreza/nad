<?php

use yii\db\Migration;

/**
 * Class m191108_165619_add_piping_stage_investigationMonitorMethods_permission
 */
class m191108_165619_add_piping_stage_investigationMonitorMethods_permission extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $items = [
            'stage.investigationMonitorMethods' => 'بررسی روشهای پایش'
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
        echo "m191108_165619_add_piping_stage_investigationMonitorMethods_permission cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191108_165619_add_piping_stage_investigationMonitorMethods_permission cannot be reverted.\n";

        return false;
    }
    */
}
