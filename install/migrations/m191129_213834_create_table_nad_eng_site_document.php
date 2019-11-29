<?php

use yii\db\Migration;

/**
 * Class m191129_213834_create_table_nad_eng_site_document
 */
class m191129_213834_create_table_nad_eng_site_document extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
            CREATE TABLE `nad_eng_site_document` ( `id` INT NOT NULL AUTO_INCREMENT , `type` INT NOT NULL , `uniqueCode` VARCHAR(255) NOT NULL , `consumer` VARCHAR(255) NOT NULL , `siteId` INT NOT NULL , `createdAt` INT NOT NULL , `updatedAt` INT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

            ALTER TABLE `nad_eng_site_document` ADD FOREIGN KEY (`siteId`) REFERENCES `nad_eng_site`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191129_213834_create_table_nad_eng_site_document cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191129_213834_create_table_nad_eng_site_document cannot be reverted.\n";

        return false;
    }
    */
}
