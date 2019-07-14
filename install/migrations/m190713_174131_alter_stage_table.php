<?php

use yii\db\Migration;

/**
 * Class m190713_174131_alter_stage_table
 */
class m190713_174131_alter_stage_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('ALTER TABLE `nad_eng_stage` ADD `consumer` VARCHAR(512) NOT NULL AFTER `updatedAt`');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190713_174131_alter_stage_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190713_174131_alter_stage_table cannot be reverted.\n";

        return false;
    }
    */
}
