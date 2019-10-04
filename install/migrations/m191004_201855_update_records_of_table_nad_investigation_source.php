<?php

use yii\db\Migration;

/**
 * Class m191004_201855_update_records_of_table_nad_investigation_source
 */
class m191004_201855_update_records_of_table_nad_investigation_source extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        update nad_investigation_source set userHolder = 0 where `nad_investigation_source`.`STATUS` != 0 and `nad_investigation_source`.`STATUS` != 5 and `nad_investigation_source`.`STATUS` != 8; -- 0 = STATUS_INPROGRESS  ,  5 = STATUS_NEED_CORRECTION   ,  8 = STATUS_IN_NEXT_STEP


        update nad_investigation_source set userHolder = 1 where `nad_investigation_source`.`STATUS` = 0 or `nad_investigation_source`.`STATUS` = 5 or `nad_investigation_source`.`STATUS` = 8; -- 0 = STATUS_INPROGRESS  ,  5 = STATUS_NEED_CORRECTION   ,  8 = STATUS_IN_NEXT_STEP
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191004_201855_update_records_of_table_nad_investigation_source cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191004_201855_update_records_of_table_nad_investigation_source cannot be reverted.\n";

        return false;
    }
    */
}
