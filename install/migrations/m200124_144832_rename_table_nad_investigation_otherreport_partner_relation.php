<?php

use yii\db\Migration;

/**
 * Class m200124_144832_rename_table_nad_investigation_otherreport_partner_relation
 */
class m200124_144832_rename_table_nad_investigation_otherreport_partner_relation extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        RENAME TABLE nad_investigation_otherreport_partner_relation TO nad_investigation_subject_partner_relation;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200124_144832_rename_table_nad_investigation_otherreport_partner_relation cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200124_144832_rename_table_nad_investigation_subject_partner_relation cannot be reverted.\n";

        return false;
    }
    */
}
