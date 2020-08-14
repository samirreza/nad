<?php

use yii\db\Migration;

/**
 * Class m200814_172438_create_table_nad_purchase_forms_lookup
 */
class m200814_172438_create_table_nad_purchase_forms_lookup extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        CREATE TABLE `nad_purchase_forms_lookup` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `tableName` VARCHAR ( 255 ) NOT NULL,
            `title` VARCHAR ( 512 ) NOT NULL,
            `baseUrl` VARCHAR ( 512 ) NOT NULL,
        PRIMARY KEY ( `id` )
        ) ENGINE = INNODB;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200814_172438_create_table_nad_purchase_forms_lookup cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200814_172438_create_table_nad_purchase_forms_lookup cannot be reverted.\n";

        return false;
    }
    */
}
