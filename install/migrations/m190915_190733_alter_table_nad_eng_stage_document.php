<?php

use yii\db\Migration;

/**
 * Class m190915_190733_alter_table_nad_eng_stage_document
 */
class m190915_190733_alter_table_nad_eng_stage_document extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
            ALTER TABLE `nad_eng_stage_document` 
            DROP COLUMN `code`;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190915_190733_alter_table_nad_eng_stage_document cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190915_190733_alter_table_nad_eng_stage_document cannot be reverted.\n";

        return false;
    }
    */
}
