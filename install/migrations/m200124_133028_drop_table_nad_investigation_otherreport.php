<?php

use yii\db\Migration;

/**
 * Class m200124_133028_drop_table_nad_investigation_otherreport
 */
class m200124_133028_drop_table_nad_investigation_otherreport extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        DROP TABLE nad_investigation_otherreport;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200124_133028_drop_table_nad_investigation_otherreport cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200124_133028_drop_table_nad_investigation_otherreport cannot be reverted.\n";

        return false;
    }
    */
}
