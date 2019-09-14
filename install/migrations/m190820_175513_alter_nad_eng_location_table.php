<?php

use yii\db\Migration;

/**
 * Class m190820_175513_alter_nad_eng_location_table
 */
class m190820_175513_alter_nad_eng_location_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
            ALTER TABLE `nad_eng_location` DROP FOREIGN KEY `nad_eng_location_FK1`;
            ALTER TABLE `nad_eng_location` ADD CONSTRAINT `nad_eng_location_FK1` FOREIGN KEY (`categoryId`) REFERENCES `nad_eng_stage_category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
            ');        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190820_175513_alter_nad_eng_location_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190820_175513_alter_nad_eng_location_table cannot be reverted.\n";

        return false;
    }
    */
}
