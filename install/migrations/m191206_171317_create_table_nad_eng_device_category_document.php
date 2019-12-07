<?php

use yii\db\Migration;

/**
 * Class m191206_171317_create_table_nad_eng_device_category_document
 */
class m191206_171317_create_table_nad_eng_device_category_document extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
            CREATE TABLE `nad_eng_device_category_document`  (
                `id` int(0) NOT NULL,
                `createdAt` int(0) NOT NULL,
                `updatedAt` int(0) NULL,
                `categoryId` int(0) NULL,
                `title` varchar(255) NULL,
                `format` int(0) NULL,
                `code` varchar(255) NULL,
                `uniqueCode` varchar(255) NULL,
                PRIMARY KEY (`id`),
                FOREIGN KEY (`categoryId`) REFERENCES `nad_eng_device_category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
            );
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191206_171317_create_table_nad_eng_device_category_document cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191206_171317_create_table_nad_eng_device_category_document cannot be reverted.\n";

        return false;
    }
    */
}
