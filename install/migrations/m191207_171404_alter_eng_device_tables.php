<?php

use yii\db\Migration;

/**
 * Class m191207_171404_alter_eng_device_tables
 */
class m191207_171404_alter_eng_device_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        SET FOREIGN_KEY_CHECKS = 0;
        ALTER TABLE `nad_eng_device` MODIFY COLUMN `id` int(11) NOT NULL AUTO_INCREMENT FIRST;
        ALTER TABLE `nad_eng_device_document` MODIFY COLUMN `id` int(11) NOT NULL AUTO_INCREMENT FIRST;
        ALTER TABLE `nad_eng_device_category_document` MODIFY COLUMN `id` int(11) NOT NULL AUTO_INCREMENT FIRST;
        ALTER TABLE `nad_eng_device_part` MODIFY COLUMN `id` int(11) NOT NULL AUTO_INCREMENT FIRST;
        ALTER TABLE `nad_eng_device_part_document` MODIFY COLUMN `id` int(11) NOT NULL AUTO_INCREMENT FIRST;
        ALTER TABLE `nad_eng_device_instance` MODIFY COLUMN `id` int(11) NOT NULL AUTO_INCREMENT FIRST;
        ALTER TABLE `nad_eng_device_part_instance` MODIFY COLUMN `id` int(11) NOT NULL AUTO_INCREMENT FIRST;
        ALTER TABLE `nad_eng_device_instance_document` MODIFY COLUMN `id` int(11) NOT NULL AUTO_INCREMENT FIRST;
        SET FOREIGN_KEY_CHECKS = 1;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191207_171404_alter_eng_device_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191207_171404_alter_eng_device_tables cannot be reverted.\n";

        return false;
    }
    */
}
