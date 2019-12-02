<?php

use yii\db\Migration;

/**
 * Class m191202_190344_alter_table_user
 */
class m191202_190344_alter_table_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        ALTER TABLE `user` ADD COLUMN `post` varchar(255) NULL AFTER `identityCode`;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191202_190344_alter_table_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191202_190344_alter_table_user cannot be reverted.\n";

        return false;
    }
    */
}
