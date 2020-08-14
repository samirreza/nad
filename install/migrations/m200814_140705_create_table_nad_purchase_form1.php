<?php

use yii\db\Migration;

/**
 * Class m200814_140705_create_table_nad_purchase_form1
 */
class m200814_140705_create_table_nad_purchase_form1 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        CREATE TABLE `nad_purchase_form1` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `createdBy` INT NOT NULL,
            `updatedBy` INT NULL,
            `createdAt` INT NOT NULL,
            `updatedAt` INT NULL,
            `title` VARCHAR ( 512 ) NOT NULL,
            `reason` TEXT NULL,
        PRIMARY KEY ( `id` )
        ) ENGINE = INNODB;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200814_140705_create_table_nad_purchase_form1 cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200814_140705_create_table_nad_purchase_form1 cannot be reverted.\n";

        return false;
    }
    */
}
