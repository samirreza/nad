<?php

use yii\db\Migration;

/**
 * Class m200207_230553_create_table_nad_eng_device_document_group
 */
class m200207_230553_create_table_nad_eng_device_document_group extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        --
        -- Table structure for table `nad_eng_device_document_group`
        --

        CREATE TABLE `nad_eng_device_document_group` (
        `id` int(11) NOT NULL,
        `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `uniqueCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
        `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `description` text COLLATE utf8_unicode_ci,
        `deviceId` int(11) NOT NULL,
        `createdAt` int(11) DEFAULT NULL,
        `updatedAt` int(11) DEFAULT NULL,
        `consumer` varchar(512) COLLATE utf8_unicode_ci NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

        --
        -- Indexes for dumped tables
        --

        --
        -- Indexes for table `nad_eng_device_document_group`
        --
        ALTER TABLE `nad_eng_device_document_group`
        ADD PRIMARY KEY (`id`),
        ADD KEY `nad_eng_location_FK1` (`deviceId`);

        --
        -- AUTO_INCREMENT for dumped tables
        --

        --
        -- AUTO_INCREMENT for table `nad_eng_device_document_group`
        --
        ALTER TABLE `nad_eng_device_document_group`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

        --
        -- Constraints for dumped tables
        --

        --
        -- Constraints for table `nad_eng_device_document_group`
        --
        ALTER TABLE `nad_eng_device_document_group`
        ADD CONSTRAINT `nad_eng_device_document_group_ibfk_1` FOREIGN KEY (`deviceId`) REFERENCES `nad_eng_device` (`id`);
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200207_230553_create_table_nad_eng_device_document_group cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200207_230553_create_table_nad_eng_device_document_group cannot be reverted.\n";

        return false;
    }
    */
}
