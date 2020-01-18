<?php

use yii\db\Migration;

/**
 * Class m200117_164545_create_investigation_otherreport_tables
 */
class m200117_164545_create_investigation_otherreport_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
            -- ----------------------------
            -- Table structure for nad_investigation_otherreport
            -- ----------------------------

            CREATE TABLE `nad_investigation_otherreport`  (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
            `englishTitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
            `createdAt` int(11) NOT NULL,
            `abstract` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
            `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
            `status` smallint(6) NOT NULL DEFAULT 0,
            `createdBy` int(11) NOT NULL,
            `updatedAt` int(11) NOT NULL,
            `deliverToManagerDate` int(11) NULL DEFAULT NULL,
            `sessionDate` int(11) NULL DEFAULT NULL,
            `proceedings` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
            `negotiationResult` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
            `lastCodeNumber` int(11) NOT NULL,
            `uniqueCode` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
            `consumer` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
            `isArchived` int(11) NOT NULL DEFAULT 1,
            `userHolder` int(11) NULL DEFAULT NULL,
            `subjectId` int(11) NULL DEFAULT NULL,
            PRIMARY KEY (`id`) USING BTREE,
            INDEX `subjectId`(`subjectId`) USING BTREE,
            CONSTRAINT `nad_investigation_otherreport_ibfk_1` FOREIGN KEY (`subjectId`) REFERENCES `nad_investigation_subject` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
            ) ENGINE = InnoDB AUTO_INCREMENT = 252 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

            -- ----------------------------
            -- Table structure for nad_investigation_otherreport_partner_relation
            -- ----------------------------

            CREATE TABLE `nad_investigation_otherreport_partner_relation`  (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `otherreportId` int(11) NOT NULL,
            `expertId` int(11) NOT NULL,
            PRIMARY KEY (`id`) USING BTREE,
            INDEX `nad_investigation_instruction_partner_relation_instructionId`(`otherreportId`) USING BTREE,
            INDEX `nad_investigation_instruction_partner_relation_expertId`(`expertId`) USING BTREE,
            CONSTRAINT `nad_investigation_otherreport_partner_relation_ibfk_1` FOREIGN KEY (`expertId`) REFERENCES `nad_office_expert` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
            CONSTRAINT `nad_investigation_otherreport_partner_relation_ibfk_2` FOREIGN KEY (`otherreportId`) REFERENCES `nad_investigation_otherreport` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200117_164545_create_investigation_otherreport_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200117_164545_create_investigation_otherreport_tables cannot be reverted.\n";

        return false;
    }
    */
}
