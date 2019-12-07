<?php

use yii\db\Migration;

/**
 * Class m191206_165814_create_table_nad_eng_device_category
 */
class m191206_165814_create_table_nad_eng_device_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
            CREATE TABLE `nad_eng_device_category`  (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                `tree` int(11) NULL DEFAULT NULL,
                `lft` int(11) NOT NULL,
                `rgt` int(11) NOT NULL,
                `depth` int(11) NOT NULL,
                PRIMARY KEY (`id`) USING BTREE
            );
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191206_165814_create_table_nad_eng_device_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191206_165814_create_table_nad_eng_device_category cannot be reverted.\n";

        return false;
    }
    */
}
