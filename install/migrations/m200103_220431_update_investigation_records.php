<?php

use yii\db\Migration;

/**
 * Class m200103_220431_update_investigation_records
 */
class m200103_220431_update_investigation_records extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        update nad_investigation_proposal
        set `status` = 34 -- STATUS_WAITING_FOR_CORRECTION_BY_EXPERT
        where status = 5 and userHolder = 1; -- STATUS_NEED_CORRECTION and USER_HOLDER_EXPERT

        update nad_investigation_proposal
        set `status` = 30 -- STATUS_WAITING_FOR_CHECK_BY_MANAGER
        where status = 0 and userHolder = 0; -- STATUS_INPROGRESS and USER_HOLDER_MANAGER


        update nad_investigation_proposal
        set `status` = 31 -- STATUS_WAITING_FOR_SESSION_DATE
        where status = 2 and sessionDate is null ; -- STATUS_WAITING_FOR_SESSION


        update nad_investigation_proposal
        set `status` = 32 -- STATUS_WAITING_FOR_SESSION_RESULT
        where status = 2 and proceedings is null ; --  STATUS_WAITING_FOR_SESSION


        update nad_investigation_proposal
        set `status` = 33 -- STATUS_WAITING_FOR_SESSION_RESULT
        where status = 2 and sessionDate is not null and proceedings is not null ; --  STATUS_WAITING_FOR_SESSION

        -- --------------------------------------------------
        update nad_investigation_report
        set `status` = 34 -- STATUS_WAITING_FOR_CORRECTION_BY_EXPERT
        where status = 5 and userHolder = 1; -- STATUS_NEED_CORRECTION and USER_HOLDER_EXPERT

        update nad_investigation_report
        set `status` = 30 -- STATUS_WAITING_FOR_CHECK_BY_MANAGER
        where status = 0 and userHolder = 0; -- STATUS_INPROGRESS and USER_HOLDER_MANAGER


        update nad_investigation_report
        set `status` = 31 -- STATUS_WAITING_FOR_SESSION_DATE
        where status = 2 and sessionDate is null ; -- STATUS_WAITING_FOR_SESSION


        update nad_investigation_report
        set `status` = 32 -- STATUS_WAITING_FOR_SESSION_RESULT
        where status = 2 and proceedings is null ; --  STATUS_WAITING_FOR_SESSION


        update nad_investigation_report
        set `status` = 33 -- STATUS_WAITING_FOR_SESSION_RESULT
        where status = 2 and sessionDate is not null and proceedings is not null ; --  STATUS_WAITING_FOR_SESSION

        -- ----------------------------------------------------
        update nad_investigation_method
        set `status` = 34 -- STATUS_WAITING_FOR_CORRECTION_BY_EXPERT
        where status = 5 and userHolder = 1; -- STATUS_NEED_CORRECTION and USER_HOLDER_EXPERT

        update nad_investigation_method
        set `status` = 30 -- STATUS_WAITING_FOR_CHECK_BY_MANAGER
        where status = 0 and userHolder = 0; -- STATUS_INPROGRESS and USER_HOLDER_MANAGER


        update nad_investigation_method
        set `status` = 31 -- STATUS_WAITING_FOR_SESSION_DATE
        where status = 2 and sessionDate is null ; -- STATUS_WAITING_FOR_SESSION


        update nad_investigation_method
        set `status` = 32 -- STATUS_WAITING_FOR_SESSION_RESULT
        where status = 2 and proceedings is null ; --  STATUS_WAITING_FOR_SESSION


        update nad_investigation_method
        set `status` = 33 -- STATUS_WAITING_FOR_SESSION_RESULT
        where status = 2 and sessionDate is not null and proceedings is not null ; --  STATUS_WAITING_FOR_SESSION

        -- -----------------------------------------------
        update nad_investigation_instruction
        set `status` = 34 -- STATUS_WAITING_FOR_CORRECTION_BY_EXPERT
        where status = 5 and userHolder = 1; -- STATUS_NEED_CORRECTION and USER_HOLDER_EXPERT

        update nad_investigation_instruction
        set `status` = 30 -- STATUS_WAITING_FOR_CHECK_BY_MANAGER
        where status = 0 and userHolder = 0; -- STATUS_INPROGRESS and USER_HOLDER_MANAGER


        update nad_investigation_instruction
        set `status` = 31 -- STATUS_WAITING_FOR_SESSION_DATE
        where status = 2 and sessionDate is null ; -- STATUS_WAITING_FOR_SESSION


        update nad_investigation_instruction
        set `status` = 32 -- STATUS_WAITING_FOR_SESSION_RESULT
        where status = 2 and proceedings is null ; --  STATUS_WAITING_FOR_SESSION


        update nad_investigation_instruction
        set `status` = 33 -- STATUS_WAITING_FOR_SESSION_RESULT
        where status = 2 and sessionDate is not null and proceedings is not null ; --  STATUS_WAITING_FOR_SESSION

        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200103_220431_update_investigation_records cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200103_220431_update_investigation_records cannot be reverted.\n";

        return false;
    }
    */
}
