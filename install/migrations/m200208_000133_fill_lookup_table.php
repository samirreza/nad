<?php

use yii\db\Migration;

/**
 * Class m200208_000133_fill_lookup_table
 */
class m200208_000133_fill_lookup_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        INSERT INTO `lookup` (`id`, `name`, `type`, `code`, `position`, `extra`) VALUES (NULL, 'نقشه', 'nad.device.documentGroup.type', '1', '1', 'M'), (NULL, 'نگهداری و حمل', 'nad.device.documentGroup.type', '2', '2', 'T'), (NULL, 'کاتالوگ', 'nad.device.documentGroup.type', '3', '3', 'C'), (NULL, 'نمودار', 'nad.device.documentGroup.type', '4', '4', 'D'), (NULL, 'گزارش', 'nad.device.documentGroup.type', '5', '5', 'R'), (NULL, 'عکس', 'nad.device.documentGroup.type', '6', '6', 'P')
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200208_000133_fill_lookup_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200208_000133_fill_lookup_table cannot be reverted.\n";

        return false;
    }
    */
}
