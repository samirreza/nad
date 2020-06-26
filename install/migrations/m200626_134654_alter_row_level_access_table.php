<?php

use yii\db\Migration;

/**
 * Class m200626_134654_alter_row_level_access_table
 */
class m200626_134654_alter_row_level_access_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
            ALTER TABLE `row_level_access`
                ADD COLUMN `createdAt` int(11) NULL AFTER `expire_date`;
            ALTER TABLE `row_level_access_preview`
                ADD COLUMN `createdAt` int(11) NULL AFTER `expire_date`;

            UPDATE `row_level_access` SET createdAt = CURRENT_TIMESTAMP;
            UPDATE `row_level_access_preview` SET createdAt = CURRENT_TIMESTAMP;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200626_134654_alter_row_level_access_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200626_134654_alter_row_level_access_table cannot be reverted.\n";

        return false;
    }
    */
}
