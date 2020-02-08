<?php

use yii\db\Migration;

/**
 * Class m200208_012405_fill_lookup_table
 */
class m200208_012405_fill_lookup_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        INSERT INTO `lookup` (`id`, `name`, `type`, `code`, `position`, `extra`) VALUES (NULL, 'PDF', 'nad.device.DocumentGroupDocument.Type', '1', '1', NULL), (NULL, 'Digit', 'nad.device.DocumentGroupDocument.Type', '2', '2', NULL), (NULL, 'Solidworks', 'nad.device.DocumentGroupDocument.Type', '3', '3', NULL), (NULL, 'Catia', 'nad.device.DocumentGroupDocument.Type', '4', '4', NULL), (NULL, 'Autocad', 'nad.device.DocumentGroupDocument.Type', '5', '5', NULL), (NULL, 'JPEG/PNG', 'nad.device.DocumentGroupDocument.Type', '6', '6', NULL);
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200208_012405_fill_lookup_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200208_012405_fill_lookup_table cannot be reverted.\n";

        return false;
    }
    */
}
