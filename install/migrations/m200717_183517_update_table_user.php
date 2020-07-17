<?php

use yii\db\Migration;

/**
 * Class m200717_183517_update_table_user
 */
class m200717_183517_update_table_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('update `user` set type=5 where type=2');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200717_183517_update_table_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200717_183517_update_table_user cannot be reverted.\n";

        return false;
    }
    */
}
