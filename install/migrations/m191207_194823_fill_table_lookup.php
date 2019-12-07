<?php

use yii\db\Migration;

/**
 * Class m191207_194823_fill_table_lookup
 */
class m191207_194823_fill_table_lookup extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        INSERT INTO `lookup` (`id`, `name`, `type`, `code`, `position`) VALUES
        (NULL, 'غیراستاندارد خاص', 'nad.device.devicePart.groupType', '1', '1'),
        (NULL, 'غیراستاندارد', 'nad.device.devicePart.groupType', '2', '2'),
        (NULL, 'استاندارد', 'nad.device.devicePart.groupType', '3', '3');
        -- -----------------------------------------------------------
        INSERT INTO `lookup` (`id`, `name`, `type`, `code`, `position`) VALUES
        (NULL, 'نقشه انفجاری - E', 'nad.device.deviceDocument.docName', '1', '1'),
        (NULL, 'نقشه مونتاژ - A', 'nad.device.deviceDocument.docName', '2', '2'),
        (NULL, 'نقشه ساخت - F', 'nad.device.deviceDocument.docName', '3', '3'),
        (NULL, 'دستورالعمل نگهداری - M', 'nad.device.deviceDocument.docName', '4', '4'),
        (NULL, 'کاتالوگ - C', 'nad.device.deviceDocument.docName', '5', '5'),
        (NULL, 'نمودار پمپ - D', 'nad.device.deviceDocument.docName', '6', '6');
        -- -----------------------------------------------------------
        INSERT INTO `lookup` (`id`, `name`, `type`, `code`, `position`) VALUES
        (NULL, 'PDF', 'nad.device.deviceDocument.docFormat', '1', '1'),
        (NULL, 'Digit', 'nad.device.deviceDocument.docFormat', '2', '2'),
        (NULL, 'SolidWorks', 'nad.device.deviceDocument.docFormat', '3', '3'),
        (NULL, 'Catia', 'nad.device.deviceDocument.docFormat', '4', '4');
        -- ------------------------------------------------------------
        INSERT INTO `lookup` (`id`, `name`, `type`, `code`, `position`) VALUES
        (NULL, 'کتاب', 'nad.device.categoryDocument.docFormat', '1', '1'),
        (NULL, 'مقاله', 'nad.device.categoryDocument.docFormat', '2', '2');
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191207_194823_fill_table_lookup cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191207_194823_fill_table_lookup cannot be reverted.\n";

        return false;
    }
    */
}
