<?php

use yii\db\Migration;

/**
 * Class m191004_143344_alter_table_nad_investigation_source
 */
class m191004_143344_alter_table_nad_investigation_source extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        ALTER TABLE `nad_investigation_source`
            ADD COLUMN `userHolder` int(11) NULL AFTER `categoryId`;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191004_143344_alter_table_nad_investigation_source cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191004_143344_alter_table_nad_investigation_source cannot be reverted.\n";

        return false;
    }
    */
}
