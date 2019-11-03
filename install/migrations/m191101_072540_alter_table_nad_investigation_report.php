<?php

use yii\db\Migration;

/**
 * Class m191101_072540_alter_table_nad_investigation_report
 */
class m191101_072540_alter_table_nad_investigation_report extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        ALTER TABLE `nad_investigation_report` ADD COLUMN `expertId` int(11) NULL AFTER `categoryId`;
        ALTER TABLE `nad_investigation_report` ADD COLUMN `isArchived` int(11) NULL AFTER `categoryId`;
        ALTER TABLE `nad_investigation_report` ADD COLUMN `userHolder` int(11) NULL AFTER `categoryId`;
        ALTER TABLE `nad_investigation_report` MODIFY COLUMN `isArchived` int(11) NULL DEFAULT 1;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191101_072540_alter_table_nad_investigation_report cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191101_072540_alter_table_nad_investigation_report cannot be reverted.\n";

        return false;
    }
    */
}
