<?php

use yii\db\Migration;

/**
 * Class m191206_170122_create_table_nad_eng_device
 */
class m191206_170122_create_table_nad_eng_device extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        CREATE TABLE `nad_eng_device`  (
            `id` int(0) NOT NULL,
            `createdAt` int(0) NOT NULL,
            `updatedAt` int(0) NULL,
            `categoryId` int(0) NULL,
            `title` varchar(255) NOT NULL,
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
        echo "m191206_170122_create_table_nad_eng_device cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191206_170122_create_table_nad_eng_device cannot be reverted.\n";

        return false;
    }
    */
}
