<?php

use yii\db\Migration;

/**
 * Class m200124_222357_fill_lookup_table
 */
class m200124_222357_fill_lookup_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        INSERT INTO `lookup` (`id`, `name`, `type`, `code`, `position`, `extra`) VALUES (NULL, 'MC', 'nad.investigation.subject.missionType', '1', '1', NULL), (NULL, 'MP', 'nad.investigation.subject.missionType', '2', '2', NULL)
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200124_222357_fill_lookup_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200124_222357_fill_lookup_table cannot be reverted.\n";

        return false;
    }
    */
}
