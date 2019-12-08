<?php

use yii\db\Migration;

/**
 * Class m191208_171401_alter_table_nad_eng_device_part_instance
 */
class m191208_171401_alter_table_nad_eng_device_part_instance extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        ALTER TABLE `nad_eng_device_part_instance` ADD COLUMN `deviceInstanceId` int(0) NULL AFTER `uniqueCode`;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191208_171401_alter_table_nad_eng_device_part_instance cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191208_171401_alter_table_nad_eng_device_part_instance cannot be reverted.\n";

        return false;
    }
    */
}
