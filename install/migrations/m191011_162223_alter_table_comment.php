<?php

use yii\db\Migration;

/**
 * Class m191011_162223_alter_table_comment
 */
class m191011_162223_alter_table_comment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        ALTER TABLE `comment`
            ADD COLUMN `modelClassNameFull` varchar(255) NULL AFTER `modelId`;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191011_162223_alter_table_comment cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191011_162223_alter_table_comment cannot be reverted.\n";

        return false;
    }
    */
}
