<?php

use yii\db\Migration;

/**
 * Class m191202_182909_fill_table_nad_office_expert
 */
class m191202_182909_fill_table_nad_office_expert extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        INSERT INTO `nad_office_expert` ( userId, createdAt, updatedAt, departmentId ) SELECT
            id,
            UNIX_TIMESTAMP( ),
            UNIX_TIMESTAMP( ),
            0
            FROM
            `user`
            WHERE
                id NOT IN ( SELECT userId FROM `nad_office_expert` )
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191202_182909_fill_table_nad_office_expert cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191202_182909_fill_table_nad_office_expert cannot be reverted.\n";

        return false;
    }
    */
}
