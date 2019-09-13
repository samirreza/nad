<?php

use yii\db\Migration;

/**
 * Class m190913_163154_create_table_lookup
 */
class m190913_163154_create_table_lookup extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
            CREATE TABLE `lookup` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
                `code` int(11) NOT NULL,
                `position` int(11) NOT NULL,
                PRIMARY KEY (`id`)
            );
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190913_163154_create_table_lookup cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190913_163154_create_table_lookup cannot be reverted.\n";

        return false;
    }
    */
}
