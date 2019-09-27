<?php

use yii\db\Migration;

/**
 * Class m190927_200839_alter_table_nad_investigation_reference
 */
class m190927_200839_alter_table_nad_investigation_reference extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        ALTER TABLE `nad_investigation_reference` ADD `usableFor` INT NULL AFTER `createdBy`;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190927_200839_alter_table_nad_investigation_reference cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190927_200839_alter_table_nad_investigation_reference cannot be reverted.\n";

        return false;
    }
    */
}
