<?php

use yii\db\Migration;

/**
 * Class m200125_181550_fill_lookup_table
 */
class m200125_181550_fill_lookup_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        INSERT INTO `lookup` (`id`, `name`, `type`, `code`, `position`, `extra`) VALUES (NULL, 'پیشنهاد', 'nad.investigation.subject.seoCode', '1', '1', 'S'), (NULL, 'تجربیات', 'nad.investigation.subject.seoCode', '2', '2', 'E'), (NULL, 'مشاهده', 'nad.investigation.subject.seoCode', '3', '3', 'O')
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200125_181550_fill_lookup_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200125_181550_fill_lookup_table cannot be reverted.\n";

        return false;
    }
    */
}
