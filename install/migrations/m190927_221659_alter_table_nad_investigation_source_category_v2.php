<?php

use yii\db\Migration;

/**
 * Class m190927_221659_alter_table_nad_investigation_source_category_v2
 */
class m190927_221659_alter_table_nad_investigation_source_category_v2 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        ALTER TABLE `nad_investigation_source_category` ADD `consumer` varchar(255) COLLATE utf8_unicode_ci NOT NULL;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190927_221659_alter_table_nad_investigation_source_category_v2 cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190927_221659_alter_table_nad_investigation_source_category_v2 cannot be reverted.\n";

        return false;
    }
    */
}
