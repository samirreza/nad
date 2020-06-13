<?php

use yii\db\Migration;

/**
 * Class m200612_180353_row_level_access_request
 */
class m200612_180353_row_level_access_request extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE row_level_access_request  (
                `id` int(0) NOT NULL,
                `createdAt` int(11) NULL,
                `updatedAt` int(11) NULL,
                `description` text NOT NULL,
                `type` int(11) NOT NULL,
                `status` int(11) NOT NULL,
                `is_read` int(11) NOT NULL,
                `createdBy` int(11) NOT NULL,
                `updatedBy` int(11) NULL,
                PRIMARY KEY (`id`)
            );
            ALTER TABLE `row_level_access_request`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200612_180353_row_level_access_request cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200612_180353_row_level_access_request cannot be reverted.\n";

        return false;
    }
    */
}
