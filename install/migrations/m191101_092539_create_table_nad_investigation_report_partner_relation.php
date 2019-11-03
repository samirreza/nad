<?php

use yii\db\Migration;

/**
 * Class m191101_092539_create_table_nad_investigation_report_partner_relation
 */
class m191101_092539_create_table_nad_investigation_report_partner_relation extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        CREATE TABLE `nad_investigation_report_partner_relation`  (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `reportId` int(11) NOT NULL,
            `expertId` int(11) NOT NULL,
            PRIMARY KEY (`id`) USING BTREE,
            INDEX `nad_investigation_report_partner_relation_reportId`(`reportId`) USING BTREE,
            INDEX `nad_investigation_report_partner_relation_expertId`(`expertId`) USING BTREE,
            CONSTRAINT `nad_investigation_report_partner_relation_expertId` FOREIGN KEY (`expertId`) REFERENCES `nad_office_expert` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
            CONSTRAINT `nad_investigation_report_partner_relation_reportId` FOREIGN KEY (`reportId`) REFERENCES `nad_investigation_report` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
          ) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

          SET FOREIGN_KEY_CHECKS = 1;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191101_092539_create_table_nad_investigation_report_partner_relation cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191101_092539_create_table_nad_investigation_report_partner_relation cannot be reverted.\n";

        return false;
    }
    */
}
