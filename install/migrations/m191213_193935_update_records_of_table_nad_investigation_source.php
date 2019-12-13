<?php

use yii\db\Migration;

/**
 * Class m191213_193935_update_records_of_table_nad_investigation_source
 */
class m191213_193935_update_records_of_table_nad_investigation_source extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        update nad_investigation_source
        set `status` = 34 -- STATUS_WAITING_FOR_CORRECTION_BY_EXPERT
        where status = 5 and userHolder = 1; -- STATUS_NEED_CORRECTION and USER_HOLDER_EXPERT

        update nad_investigation_source
        set `status` = 30 -- STATUS_WAITING_FOR_CHECK_BY_MANAGER
        where status = 0 and userHolder = 0; -- STATUS_INPROGRESS and USER_HOLDER_MANAGER


        update nad_investigation_source
        set `status` = 31 -- STATUS_WAITING_FOR_SESSION_DATE
        where status = 2 and sessionDate is null ; -- STATUS_WAITING_FOR_SESSION


        update nad_investigation_source
        set `status` = 32 -- STATUS_WAITING_FOR_SESSION_RESULT
        where status = 2 and proceedings is null ; --  STATUS_WAITING_FOR_SESSION


        update nad_investigation_source
        set `status` = 33 -- STATUS_WAITING_FOR_SESSION_RESULT
        where status = 2 and sessionDate is not null and proceedings is not null ; --  STATUS_WAITING_FOR_SESSION
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191213_193935_update_records_of_table_nad_investigation_source cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191213_193935_update_records_of_table_nad_investigation_source cannot be reverted.\n";

        return false;
    }
    */
}
