<?php

use yii\db\Migration;

/**
 * Class m200208_172129_alter_device_tables_by_adding_consumer_column
 */
class m200208_172129_alter_device_tables_by_adding_consumer_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        ALTER TABLE `nad_eng_device_category` ADD COLUMN `consumer` varchar(512) NULL;
        ALTER TABLE `nad_eng_device_category_document` ADD COLUMN `consumer` varchar(512) NULL;
        ALTER TABLE `nad_eng_device` ADD COLUMN `consumer` varchar(512) NULL;
        ALTER TABLE `nad_eng_device_document` ADD COLUMN `consumer` varchar(512) NULL;
        ALTER TABLE `nad_eng_device_part` ADD COLUMN `consumer` varchar(512) NULL;
        ALTER TABLE `nad_eng_device_part_document` ADD COLUMN `consumer` varchar(512) NULL;
        ALTER TABLE `nad_eng_device_instance` ADD COLUMN `consumer` varchar(512) NULL;
        ALTER TABLE `nad_eng_device_instance_document` ADD COLUMN `consumer` varchar(512) NULL;
        ALTER TABLE `nad_eng_device_part_instance` ADD COLUMN `consumer` varchar(512) NULL;
        ALTER TABLE `nad_eng_device_part_instance_document` ADD COLUMN `consumer` varchar(512) NULL;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200208_172129_alter_device_tables_by_adding_consumer_column cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200208_172129_alter_device_tables_by_adding_consumer_column cannot be reverted.\n";

        return false;
    }
    */
}
