<?php

use yii\db\Migration;

/**
 * Class m200814_142110_create_table_nad_purchase_form4
 */
class m200814_142110_create_table_nad_purchase_form4 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        CREATE TABLE `nad_purchase_form4` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `createdBy` INT NOT NULL,
            `updatedBy` INT NULL,
            `createdAt` INT NOT NULL,
            `updatedAt` INT NULL,
            `title` VARCHAR ( 512 ) NOT NULL,
            `factorNumber` VARCHAR ( 512 ) NOT NULL,
            `price` DECIMAL(30,0) NOT NULL,
            `productName` VARCHAR ( 512 ) NOT NULL,
            `technicalNumber` VARCHAR ( 512 ) NULL,
            `accountNumber` VARCHAR ( 512 ) NULL,
            `accountOwnerName` VARCHAR ( 512 ) NULL,
            `accountBankName` VARCHAR ( 512 ) NULL,
            `purchaseGlobalId` INT NOT NULL,
        PRIMARY KEY ( `id` )
        ) ENGINE = INNODB;

        ALTER TABLE `nad_purchase_form1` ADD `nextFormId` INT NULL, ADD `nextExpertId` INT NULL;
        ALTER TABLE `nad_purchase_form2` ADD `nextFormId` INT NULL, ADD `nextExpertId` INT NULL;
        ALTER TABLE `nad_purchase_form3` ADD `nextFormId` INT NULL, ADD `nextExpertId` INT NULL;
        ALTER TABLE `nad_purchase_form4` ADD `nextFormId` INT NULL, ADD `nextExpertId` INT NULL;

        ALTER TABLE `nad_purchase_form2` ADD `prevFormId` INT NOT NULL;
        ALTER TABLE `nad_purchase_form3` ADD `prevFormId` INT NOT NULL;
        ALTER TABLE `nad_purchase_form4` ADD `prevFormId` INT NOT NULL;

        ALTER TABLE `nad_purchase_form2` ADD `prevExpertId` INT NOT NULL;
        ALTER TABLE `nad_purchase_form3` ADD `prevExpertId` INT NOT NULL;
        ALTER TABLE `nad_purchase_form4` ADD `prevExpertId` INT NOT NULL;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200814_142110_create_table_nad_purchase_form4 cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200814_142110_create_table_nad_purchase_form4 cannot be reverted.\n";

        return false;
    }
    */
}
