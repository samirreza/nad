<?php

use yii\db\Migration;

/**
 * Class m200814_141533_create_table_nad_purchase_form3
 */
class m200814_141533_create_table_nad_purchase_form3 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        CREATE TABLE `nad_purchase_form3` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `createdBy` INT NOT NULL,
            `updatedBy` INT NULL,
            `createdAt` INT NOT NULL,
            `updatedAt` INT NULL,
            `title` VARCHAR ( 512 ) NOT NULL,
            `productName` VARCHAR ( 512 ) NOT NULL,
            `productIdentifier` VARCHAR ( 512 ) NOT NULL,
            `deliveryDate` INT NULL,
            `price` DECIMAL(30,0) NULL,
            `prepayment` DECIMAL(30,0) NULL,
            `purchaseGlobalId` INT NOT NULL,
        PRIMARY KEY ( `id` )
        ) ENGINE = INNODB;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200814_141533_create_table_nad_purchase_form3 cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200814_141533_create_table_nad_purchase_form3 cannot be reverted.\n";

        return false;
    }
    */
}
