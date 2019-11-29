<?php

use yii\db\Migration;

/**
 * Class m191129_151559_fill_lookup_table
 */
class m191129_151559_fill_lookup_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        INSERT INTO `lookup` (`id`, `name`, `type`, `code`, `position`) VALUES (NULL, '1. نقشه جانمایی', 'nad.site.document.Type', '1', '1'), (NULL, '2. P&ID', 'nad.site.document.Type', '2', '2'), (NULL, '3. نقشه هوایی', 'nad.site.document.Type', '3', '3'), (NULL, '4. عکس', 'nad.site.document.Type', '4', '4');
        INSERT INTO `lookup` (`id`, `name`, `type`, `code`, `position`) VALUES (NULL, 'UTM', 'nad.site.site.CoordinatesType', '1', '1'), (NULL, 'GPS', 'nad.site.site.CoordinatesType', '2', '2');
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191129_151559_fill_lookup_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191129_151559_fill_lookup_table cannot be reverted.\n";

        return false;
    }
    */
}
