<?php

use yii\db\Migration;

/**
 * Class m190927_152446_alter_table_nad_investigation_source
 */
class m190927_152446_alter_table_nad_investigation_source extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        ALTER TABLE `nad_investigation_source` ADD `isArchived` INT NOT NULL DEFAULT '1' AFTER `consumer`;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190927_152446_alter_table_nad_investigation_source cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190927_152446_alter_table_nad_investigation_source cannot be reverted.\n";

        return false;
    }
    */
}
