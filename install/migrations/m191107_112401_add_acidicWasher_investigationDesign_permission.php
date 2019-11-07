<?php

use yii\db\Migration;

/**
 * Class m191107_112401_add_acidicWasher_investigationDesign_permission
 */
class m191107_112401_add_acidicWasher_investigationDesign_permission extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $items = [
            'acidicWasher.investigationDesign' => 'بررسی طراحی'
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
        echo "m191107_112401_add_acidicWasher_investigationDesign_permission cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191107_112401_add_acidicWasher_investigationDesign_permission cannot be reverted.\n";

        return false;
    }
    */
}
