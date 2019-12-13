<?php

use yii\db\Migration;

/**
 * Class m191213_130827_create_table_nad_eng_device_part_instance_document
 */
class m191213_130827_create_table_nad_eng_device_part_instance_document extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        --
        -- Table structure for table `nad_eng_device_part_instance_document`
        --

        CREATE TABLE `nad_eng_device_part_instance_document` (
        `id` int(11) NOT NULL,
        `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `createdAt` int(11) NOT NULL,
        `updatedAt` int(11) DEFAULT NULL,
        `instanceId` int(11) DEFAULT NULL,
        `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
        `uniqueCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

        --
        -- Indexes for dumped tables
        --

        --
        -- Indexes for table `nad_eng_device_part_instance_document`
        --
        ALTER TABLE `nad_eng_device_part_instance_document`
        ADD PRIMARY KEY (`id`),
        ADD KEY `partId` (`instanceId`);

        --
        -- AUTO_INCREMENT for dumped tables
        --

        --
        -- AUTO_INCREMENT for table `nad_eng_device_part_instance_document`
        --
        ALTER TABLE `nad_eng_device_part_instance_document`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

        --
        -- Constraints for dumped tables
        --

        --
        -- Constraints for table `nad_eng_device_part_instance_document`
        --
        ALTER TABLE `nad_eng_device_part_instance_document`
        ADD CONSTRAINT `nad_eng_device_part_instance_document_ibfk_1` FOREIGN KEY (`instanceId`) REFERENCES `nad_eng_device_part_instance` (`id`);
        COMMIT;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191213_130827_create_table_nad_eng_device_part_instance_document cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191213_130827_create_table_nad_eng_device_part_instance_document cannot be reverted.\n";

        return false;
    }
    */
}
