<?php

use yii\db\Migration;

/**
 * Class m200717_191107_add_roles_to_auth_item_table
 */
class m200717_191107_add_roles_to_auth_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        INSERT INTO auth_item VALUES ('process_department_manager', 1, NULL, 'userType', NULL, 1534088586, 1534088586);
        INSERT INTO auth_item VALUES ('engineering_department_manager', 1, NULL, 'userType', NULL, 1534088586, 1534088586);
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200717_191107_add_roles_to_auth_item_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200717_191107_add_roles_to_auth_item_table cannot be reverted.\n";

        return false;
    }
    */
}
