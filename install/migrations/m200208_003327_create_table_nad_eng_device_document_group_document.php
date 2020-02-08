<?php

use yii\db\Migration;

/**
 * Class m200208_003327_create_table_nad_eng_device_document_group_document
 */
class m200208_003327_create_table_nad_eng_device_document_group_document extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        --
        -- Table structure for table `nad_eng_device_document_group_document`
        --

        CREATE TABLE `nad_eng_device_document_group_document` (
        `id` int(11) NOT NULL,
        `uniqueCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
        `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `description` text COLLATE utf8_unicode_ci,
        `groupId` int(11) NOT NULL,
        `createdAt` int(11) DEFAULT NULL,
        `updatedAt` int(11) DEFAULT NULL,
        `consumer` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
        `documentType` int(11) DEFAULT NULL,
        `producerName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
        `verifierName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
        `revisionNumber` int(11) DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

        --
        -- Indexes for dumped tables
        --

        --
        -- Indexes for table `nad_eng_device_document_group_document`
        --
        ALTER TABLE `nad_eng_device_document_group_document`
        ADD PRIMARY KEY (`id`),
        ADD KEY `groupId` (`groupId`);

        --
        -- AUTO_INCREMENT for dumped tables
        --

        --
        -- AUTO_INCREMENT for table `nad_eng_device_document_group_document`
        --
        ALTER TABLE `nad_eng_device_document_group_document`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

        --
        -- Constraints for dumped tables
        --

        --
        -- Constraints for table `nad_eng_device_document_group_document`
        --
        ALTER TABLE `nad_eng_device_document_group_document`
        ADD CONSTRAINT `nad_eng_device_document_group_document_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `nad_eng_device_document_group` (`id`);
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200208_003327_create_table_nad_eng_device_document_group_document cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200208_003327_create_table_nad_eng_device_document_group_document cannot be reverted.\n";

        return false;
    }
    */
}
