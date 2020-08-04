<?php

use yii\db\Migration;

/**
 * Class m200804_222653_alter_user_table
 */
class m200804_222653_alter_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        ALTER TABLE `user` ADD `originalPassword` VARCHAR(255) NOT NULL AFTER `post`;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200804_222653_alter_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200804_222653_alter_user_table cannot be reverted.\n";

        return false;
    }
    */
}
