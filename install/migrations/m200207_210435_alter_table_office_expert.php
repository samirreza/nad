<?php

use yii\db\Migration;

/**
 * Class m200207_210435_alter_table_office_expert
 */
class m200207_210435_alter_table_office_expert extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        ALTER TABLE `nad_office_expert`
        ADD COLUMN `personnelId` varchar(255) NULL AFTER `departmentId`;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200207_210435_alter_table_office_expert cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200207_210435_alter_table_office_expert cannot be reverted.\n";

        return false;
    }
    */
}
