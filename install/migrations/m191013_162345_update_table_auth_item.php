<?php

use yii\db\Migration;

/**
 * Class m191013_162345_update_table_auth_item
 */
class m191013_162345_update_table_auth_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        UPDATE `auth_item`
        SET description = 'بررسی فرایندی'
        WHERE
            description = 'بررسی';
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191013_162345_update_table_auth_item cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191013_162345_update_table_auth_item cannot be reverted.\n";

        return false;
    }
    */
}
