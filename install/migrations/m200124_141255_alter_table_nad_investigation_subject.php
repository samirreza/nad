<?php

use yii\db\Migration;

/**
 * Class m200124_141255_alter_table_nad_investigation_subject
 */
class m200124_141255_alter_table_nad_investigation_subject extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        ALTER TABLE `nad_investigation_subject`
        ADD COLUMN `reportDeadlineDate` int(0) NULL AFTER `missionDate`,
        ADD COLUMN `missionType` int(255) NULL AFTER `reportDeadlineDate`;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200124_141255_alter_table_nad_investigation_subject cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200124_141255_alter_table_nad_investigation_subject cannot be reverted.\n";

        return false;
    }
    */
}
