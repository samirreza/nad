<?php

use yii\db\Migration;

/**
 * Class m190714_184006_alter_location_table
 */
class m190714_184006_alter_location_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('ALTER TABLE `nad_eng_location` ADD `consumer` VARCHAR(512) NOT NULL AFTER `updatedAt`');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190714_184006_alter_location_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190714_184006_alter_location_table cannot be reverted.\n";

        return false;
    }
    */
}
