<?php

use yii\db\Migration;

/**
 * Class m200623_170030_alter_row_level_access_preview_table
 */
class m200623_170030_alter_row_level_access_preview_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        ALTER TABLE `row_level_access_preview`
            ADD COLUMN `access_type` int(11) NOT NULL AFTER `item_type`,
            ADD COLUMN `expire_date` int(11) NULL DEFAULT NULL AFTER `access_type`;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200623_170030_alter_row_level_access_preview_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200623_170030_alter_row_level_access_preview_table cannot be reverted.\n";

        return false;
    }
    */
}
