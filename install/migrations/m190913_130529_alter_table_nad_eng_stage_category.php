<?php

use yii\db\Migration;

/**
 * Class m190913_130529_alter_table_nad_eng_stage_category
 */
class m190913_130529_alter_table_nad_eng_stage_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        ALTER TABLE `nad_eng_stage_category` 
            ADD COLUMN `createdAt` int(11) NULL DEFAULT NULL AFTER `depth`,
            ADD COLUMN `updatedAt` int(11) NULL DEFAULT NULL AFTER `createdAt`;
        ');        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190913_130529_alter_table_nad_eng_stage_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190913_130529_alter_table_nad_eng_stage_category cannot be reverted.\n";

        return false;
    }
    */
}
