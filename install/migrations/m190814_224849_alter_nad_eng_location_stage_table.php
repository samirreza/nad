<?php

use yii\db\Migration;

/**
 * Class m190814_224849_alter_nad_eng_location_stage_table
 */
class m190814_224849_alter_nad_eng_location_stage_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
            ALTER TABLE `nad_eng_location_stage` DROP FOREIGN KEY `nad_eng_location_stage_ibfk_2`;
            ALTER TABLE `nad_eng_location_stage` CHANGE COLUMN `stageId` `stageCategoryId` int(11) NOT NULL AFTER `locationId`;
            ALTER TABLE `nad_eng_location_stage` ADD CONSTRAINT `nad_eng_location_stage_ibfk_2` FOREIGN KEY (`stageCategoryId`) REFERENCES `nad_eng_stage_category`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
            ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190814_224849_alter_nad_eng_location_stage_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190814_224849_alter_nad_eng_location_stage_table cannot be reverted.\n";

        return false;
    }
    */
}
