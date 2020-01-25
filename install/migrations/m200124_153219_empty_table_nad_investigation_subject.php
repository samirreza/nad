<?php

use yii\db\Migration;

/**
 * Class m200124_153219_empty_table_nad_investigation_subject
 */
class m200124_153219_empty_table_nad_investigation_subject extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        DELETE FROM nad_investigation_subject WHERE 1 = 1;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200124_153219_empty_table_nad_investigation_subject cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200124_153219_empty_table_nad_investigation_subject cannot be reverted.\n";

        return false;
    }
    */
}
