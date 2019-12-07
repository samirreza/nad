<?php

use yii\db\Migration;

/**
 * Class m191206_175510_create_table_nad_eng_device_part_instance
 */
class m191206_175510_create_table_nad_eng_device_part_instance extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        CREATE TABLE `nad_eng_device_part_instance`  (
            `id` int(0) NOT NULL,
            `deviceUniqueCode` varchar(255) NULL,
            `createdAt` int(0) NOT NULL,
            `updatedAt` int(0) NULL,
            `partId` int(0) NULL,
            `code` varchar(255) NULL,
            `uniqueCode` varchar(255) NULL,
            PRIMARY KEY (`id`),
            FOREIGN KEY (`partId`) REFERENCES `nad_eng_device_part` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
          );
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191206_175510_create_table_nad_eng_device_part_instance cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191206_175510_create_table_nad_eng_device_part_instance cannot be reverted.\n";

        return false;
    }
    */
}
