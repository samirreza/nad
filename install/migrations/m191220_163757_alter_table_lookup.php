<?php

use yii\db\Migration;

/**
 * Class m191220_163757_alter_table_lookup
 */
class m191220_163757_alter_table_lookup extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        ALTER TABLE `lookup` ADD `extra` VARCHAR(255) NULL AFTER `position`;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191220_163757_alter_table_lookup cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191220_163757_alter_table_lookup cannot be reverted.\n";

        return false;
    }
    */
}
