<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%excel_file}}`.
 */
class m200711_174413_create_excel_file_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        CREATE TABLE `nad_excel_file`  (
            `id` int(0) NOT NULL AUTO_INCREMENT,
            `title` varchar(512) NOT NULL,
            `uniqueCode` varchar(255) NOT NULL,
            `description` text NULL,
            `consumer` varchar(255) NOT NULL,
            `seq_access_id` bigint(20) NULL,
            `createdBy` int(11) NOT NULL,
            `createdAt` int(11) NOT NULL,
            `updatedAt` int(11) NULL,
            `updatedBy` int(11) NULL,
            `fileData` json NULL,
            PRIMARY KEY (`id`),
            CHECK (JSON_VALID(`fileData`))
          );
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('nad_excel_file');
    }
}
