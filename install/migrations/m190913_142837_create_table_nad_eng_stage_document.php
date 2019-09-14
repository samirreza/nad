<?php

use yii\db\Migration;

/**
 * Class m190913_142837_create_table_nad_eng_stage_document
 */
class m190913_142837_create_table_nad_eng_stage_document extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
            CREATE TABLE `nad_eng_stage_document`  (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                `uniqueCode` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
                `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
                `groupId` int(11) NOT NULL,
                `createdAt` int(11) NULL DEFAULT NULL,
                `updatedAt` int(11) NULL DEFAULT NULL,
                `consumer` varchar(512) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                `documentType` int(11) NULL,
                `producerName` varchar(255) NULL,
                `verifierName` varchar(255) NULL,
                `revisionNumber` int(0) NULL,
                PRIMARY KEY (`id`),
                FOREIGN KEY (`groupId`) REFERENCES `nad_eng_location` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
            );
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190913_142837_create_table_nad_eng_stage_document cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190913_142837_create_table_nad_eng_stage_document cannot be reverted.\n";

        return false;
    }
    */
}
