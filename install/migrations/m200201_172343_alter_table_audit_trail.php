<?php

use yii\db\Migration;

/**
 * Class m200201_172343_alter_table_audit_trail
 */
class m200201_172343_alter_table_audit_trail extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        ALTER TABLE `audit_trail` ADD `isDeleted` INT NULL DEFAULT '0' AFTER `updatedBy`;
        ALTER TABLE `audit_trail` ADD `deletedAt` INT NULL AFTER `updatedBy`;
        ALTER TABLE `audit_trail` ADD `deletedBy` INT NULL AFTER `updatedBy`;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200201_172343_alter_table_audit_trail cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200201_172343_alter_table_audit_trail cannot be reverted.\n";

        return false;
    }
    */
}
