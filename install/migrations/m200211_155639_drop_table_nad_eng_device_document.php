<?php

use yii\db\Migration;

/**
 * Class m200211_155639_drop_table_nad_eng_device_document
 */
class m200211_155639_drop_table_nad_eng_device_document extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            DROP TABLE `nad_eng_device_document`;
            ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200211_155639_drop_table_nad_eng_device_document cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200211_155639_drop_table_nad_eng_device_document cannot be reverted.\n";

        return false;
    }
    */
}
