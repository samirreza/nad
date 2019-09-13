<?php

use yii\db\Migration;

/**
 * Class m190913_164320_fill_table_lookup
 */
class m190913_164320_fill_table_lookup extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            INSERT INTO `lookup` (`id`, `name`, `type`, `code`, `position`) VALUES (NULL, '1. کتاب', 'nad.stage.document.Type', '1', '1'), (NULL, '2. استاندارد', 'nad.stage.document.Type', '2', '2'), (NULL, '3. مقاله', 'nad.stage.document.Type', '3', '3'), (NULL, '4. نقشه', 'nad.stage.document.Type', '4', '4'), (NULL, '5. کاتالوگ', 'nad.stage.document.Type', '5', '5'), (NULL, '6. محاسبه', 'nad.stage.document.Type', '6', '6'), (NULL, '7. گزارش', 'nad.stage.document.Type', '7', '7'), (NULL, '8. برنامه', 'nad.stage.document.Type', '8', '8')
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190913_164320_fill_table_lookup cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190913_164320_fill_table_lookup cannot be reverted.\n";

        return false;
    }
    */
}
