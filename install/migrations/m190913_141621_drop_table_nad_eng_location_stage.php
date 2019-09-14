<?php

use yii\db\Migration;

/**
 * Class m190913_141621_drop_table_nad_eng_location_stage
 */
class m190913_141621_drop_table_nad_eng_location_stage extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
            DROP TABLE `nad_eng_location_stage`;
        ');  
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190913_141621_drop_table_nad_eng_location_stage cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190913_141621_drop_table_nad_eng_location_stage cannot be reverted.\n";

        return false;
    }
    */
}
