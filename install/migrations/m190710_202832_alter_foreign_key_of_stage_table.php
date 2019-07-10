<?php

use yii\db\Migration;

/**
 * Class m190710_202832_alter_foreign_key_of_stage_table
 */
class m190710_202832_alter_foreign_key_of_stage_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
            ALTER TABLE `nad_eng_stage` DROP FOREIGN KEY `nad_eng_stage_FK2`; ALTER TABLE `nad_eng_stage` ADD CONSTRAINT `nad_eng_stage_FK2` FOREIGN KEY (`parentId`) REFERENCES `nad_eng_stage`(`id`) ON DELETE SET NULL ON UPDATE RESTRICT;
            ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190710_202832_alter_foreign_key_of_stage_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190710_202832_alter_foreign_key_of_stage_table cannot be reverted.\n";

        return false;
    }
    */
}
