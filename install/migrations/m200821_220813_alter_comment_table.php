<?php

use yii\db\Migration;

/**
 * Class m200821_220813_alter_comment_table
 */
class m200821_220813_alter_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            ALTER TABLE `comment` ADD `receiverId` INT NULL, ADD `isSecret` VARCHAR(10) NULL DEFAULT 'F';
            ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200821_220813_alter_comment_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200821_220813_alter_comment_table cannot be reverted.\n";

        return false;
    }
    */
}
