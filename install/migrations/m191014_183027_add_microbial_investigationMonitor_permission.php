<?php

use yii\db\Migration;

/**
 * Class m191014_183027_add_microbial_investigationMonitor_permission
 */
class m191014_183027_add_microbial_investigationMonitor_permission extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $items = [
            'microbial.investigationMonitor' => 'بررسی پایش'
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
        echo "m191014_183027_add_microbial_investigationMonitor_permission cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191014_183027_add_microbial_investigationMonitor_permission cannot be reverted.\n";

        return false;
    }
    */
}
