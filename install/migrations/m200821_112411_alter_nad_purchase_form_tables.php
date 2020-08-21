<?php

use yii\db\Migration;

/**
 * Class m200821_112411_alter_nad_purchase_form_tables
 */
class m200821_112411_alter_nad_purchase_form_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        ALTER TABLE `nad_purchase_form2` ADD `prevRecordId` INT NOT NULL;
        ALTER TABLE `nad_purchase_form3` ADD `prevRecordId` INT NOT NULL;
        ALTER TABLE `nad_purchase_form4` ADD `prevRecordId` INT NOT NULL;
        ALTER TABLE `nad_purchase_forms_lookup` ADD `className` TEXT NULL;
        ALTER TABLE `nad_purchase_forms_lookup` ADD `isActive` VARCHAR(10) NOT NULL DEFAULT 'T';
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200821_112411_alter_nad_purchase_form_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200821_112411_alter_nad_purchase_form_tables cannot be reverted.\n";

        return false;
    }
    */
}
