<?php

use yii\db\Migration;

/**
 * Class m191010_150752_create_table_audit_trail
 */
class m191010_150752_create_table_audit_trail extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        CREATE TABLE `audit_trail`  (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
            `ownerClassName` varchar(255) NULL,
            `ownerId` int(0) NULL,
            `fieldName` varchar(255) NULL,
            `fieldNewValue` text NULL,
            `fieldOldValue` text NULL,
            `isUpdated` int(0) NULL,
            `isRelation` int(0) NULL,
            `updatedAt` int(0) NULL,
            `updatedBy` int(0) NULL,
            PRIMARY KEY (`id`)
          );
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191010_150752_create_table_audit_trail cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191010_150752_create_table_audit_trail cannot be reverted.\n";

        return false;
    }
    */
}
