<?php

use yii\db\Migration;

/**
 * Class m191103_204932_create_tables_for_nad_investigation_instruction
 */
class m191103_204932_create_tables_for_nad_investigation_instruction extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('

CREATE TABLE `nad_investigation_instruction_category`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tree` int(11) NULL DEFAULT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `depth` int(11) NOT NULL,
  `consumer` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
);

            CREATE TABLE `nad_investigation_instruction`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `englishTitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `createdAt` int(11) NOT NULL,
  `abstract` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
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
  `userHolder` int(11) NULL DEFAULT NULL,
  `expertId` int(11) NULL DEFAULT NULL,
  `reportId` int(11) NULL DEFAULT NULL,
  `proposalId` int(11) NULL DEFAULT NULL,
  `methodId` int(11) NULL DEFAULT NULL,
  `categoryId` int(11) NULL DEFAULT NULL,
  `isArchived` int(11) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `categoryId`(`categoryId`) USING BTREE,
  CONSTRAINT `nad_investigation_instruction_FK1` FOREIGN KEY (`categoryId`) REFERENCES `nad_investigation_instruction_category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
);

CREATE TABLE `nad_investigation_instruction_partner_relation`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `instructionId` int(11) NOT NULL,
  `expertId` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `nad_investigation_instruction_partner_relation_instructionId`(`instructionId`) USING BTREE,
  INDEX `nad_investigation_instruction_partner_relation_expertId`(`expertId`) USING BTREE,
  CONSTRAINT `nad_investigation_instruction_partner_relation_expertId` FOREIGN KEY (`expertId`) REFERENCES `nad_office_expert` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `nad_investigation_instruction_partner_relation_instructionId` FOREIGN KEY (`instructionId`) REFERENCES `nad_investigation_instruction` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);
            ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191103_204932_create_tables_for_nad_investigation_instruction cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191103_204932_create_tables_for_nad_investigation_instruction cannot be reverted.\n";

        return false;
    }
    */
}
