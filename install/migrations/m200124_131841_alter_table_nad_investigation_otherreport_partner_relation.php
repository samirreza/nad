<?php

use yii\db\Migration;

/**
 * Class m200124_131841_alter_table_nad_investigation_otherreport_partner_relation
 */
class m200124_131841_alter_table_nad_investigation_otherreport_partner_relation extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        ALTER TABLE `nad_investigation_otherreport_partner_relation`
        CHANGE COLUMN `otherreportId` `subjectId` int(11) NOT NULL AFTER `id`;

        DELETE FROM `nad_investigation_otherreport_partner_relation` WHERE 1 = 1;

        ALTER TABLE `nad_investigation_otherreport_partner_relation` DROP FOREIGN KEY `nad_investigation_otherreport_partner_relation_ibfk_2`;

        ALTER TABLE `nad_investigation_otherreport_partner_relation`
        ADD FOREIGN KEY (`subjectId`) REFERENCES `nad_investigation_subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200124_131841_alter_table_nad_investigation_otherreport_partner_relation cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200124_131841_alter_table_nad_investigation_otherreport_partner_relation cannot be reverted.\n";

        return false;
    }
    */
}
