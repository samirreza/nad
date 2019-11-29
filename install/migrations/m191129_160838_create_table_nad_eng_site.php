<?php

use yii\db\Migration;

/**
 * Class m191129_160838_create_table_nad_eng_site
 */
class m191129_160838_create_table_nad_eng_site extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
            CREATE TABLE `nad_eng_site` ( `id` INT NOT NULL AUTO_INCREMENT , `code` VARCHAR(255) NOT NULL , `uniqueCode` VARCHAR(255) NULL , `deviceTitle` VARCHAR(255) NULL , `deviceCode` VARCHAR(255) NULL , `coordinates` VARCHAR(255) NULL , `coordinatesType` INT NULL , `description` TEXT NULL , `createdAt` INT NOT NULL , `updatedAt` INT NULL , `stageCategoryId` INT NOT NULL , `consumer` VARCHAR(512) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

            ALTER TABLE `nad_eng_site` ADD FOREIGN KEY (`stageCategoryId`) REFERENCES `nad_eng_stage_category`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191129_160838_create_table_nad_eng_site cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191129_160838_create_table_nad_eng_site cannot be reverted.\n";

        return false;
    }
    */
}
