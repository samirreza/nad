<?php

use yii\db\Migration;

/**
 * Class m191213_125825_fill_table_lookup
 */
class m191213_125825_fill_table_lookup extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        DELETE FROM `lookup` WHERE type = 'nad.device.deviceDocument.docName';
        -- ------------------------------------------------------------------
        INSERT INTO `lookup` (`id`, `name`, `type`, `code`, `position`) VALUES
        (NULL, 'E - نقشه انفجاری', 'nad.device.deviceDocument.docName', '1', '1'),
        (NULL, 'A - نقشه مونتاژ', 'nad.device.deviceDocument.docName', '2', '2'),
        (NULL, 'F - نقشه ساخت', 'nad.device.deviceDocument.docName', '3', '3'),
        (NULL, 'M - دستورالعمل نگهداری', 'nad.device.deviceDocument.docName', '4', '4'),
        (NULL, 'C - کاتالوگ', 'nad.device.deviceDocument.docName', '5', '5'),
        (NULL, 'D - نمودار پمپ', 'nad.device.deviceDocument.docName', '6', '6');
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191213_125825_fill_table_lookup cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191213_125825_fill_table_lookup cannot be reverted.\n";

        return false;
    }
    */
}
