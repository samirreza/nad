<?php

use yii\db\Migration;

/**
 * Class m200117_164302_create_investigation_subject_tables
 */
class m200117_164302_create_investigation_subject_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
            -- ----------------------------
            -- Table structure for nad_investigation_subject_category
            -- ----------------------------

            CREATE TABLE `nad_investigation_subject_category`  (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
            `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
            `tree` int(11) NULL DEFAULT NULL,
            `lft` int(11) NOT NULL,
            `rgt` int(11) NOT NULL,
            `depth` int(11) NOT NULL,
            `consumer` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
            PRIMARY KEY (`id`) USING BTREE
            ) ENGINE = InnoDB AUTO_INCREMENT = 120 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

            -- ----------------------------
            -- Table structure for nad_investigation_subject
            -- ----------------------------

            CREATE TABLE `nad_investigation_subject`  (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
            `englishTitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
            `createdAt` int(11) NOT NULL,
            `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
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
            `categoryId` int(11) NULL DEFAULT NULL,
            `userHolder` int(11) NULL DEFAULT NULL,
            `expertId` int(11) NULL DEFAULT NULL,
            `missionObjective` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
            `isMissionNeeded` int(11) NULL DEFAULT NULL,
            `missionPlace` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
            `missionDate` int(11) NULL DEFAULT NULL,
            PRIMARY KEY (`id`) USING BTREE,
            INDEX `categoryId`(`categoryId`) USING BTREE,
            CONSTRAINT `nad_investigation_subject_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `nad_investigation_subject_category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
            ) ENGINE = InnoDB AUTO_INCREMENT = 252 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200117_164302_create_investigation_subject_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200117_164302_create_investigation_subject_tables cannot be reverted.\n";

        return false;
    }
    */
}
