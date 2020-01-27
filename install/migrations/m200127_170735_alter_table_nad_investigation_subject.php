<?php

use yii\db\Migration;

/**
 * Class m200127_170735_alter_table_nad_investigation_subject
 */
class m200127_170735_alter_table_nad_investigation_subject extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        ALTER TABLE `nad_investigation_subject` ADD `text2` TEXT NULL AFTER `missionType`;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200127_170735_alter_table_nad_investigation_subject cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200127_170735_alter_table_nad_investigation_subject cannot be reverted.\n";

        return false;
    }
    */
}
