<?php

use yii\db\Migration;

/**
 * Class m200124_153330_drop_table_nad_investigation_subject_category
 */
class m200124_153330_drop_table_nad_investigation_subject_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        ALTER TABLE `nad_investigation_subject` DROP FOREIGN KEY `nad_investigation_subject_ibfk_1`;
        DELETE FROM nad_investigation_subject_category WHERE 1 = 1;
        DROP TABLE nad_investigation_subject_category;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200124_153330_drop_table_nad_investigation_subject_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200124_153330_drop_table_nad_investigation_subject_category cannot be reverted.\n";

        return false;
    }
    */
}
