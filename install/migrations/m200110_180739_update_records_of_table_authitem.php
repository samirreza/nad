<?php

use yii\db\Migration;

/**
 * Class m200110_180739_update_records_of_table_authitem
 */
class m200110_180739_update_records_of_table_authitem extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        UPDATE `auth_item`
        SET description = 'مطالعات کلی و دستورالعمل ها'
        WHERE
            NAME = 'acidicWasher.investigationDesign'
            OR NAME = 'alkalineWasher.investigationDesign'
            OR NAME = 'antimicrobial.investigationDesign'
            OR NAME = 'coagulant.investigationDesign'
            OR NAME = 'colors.investigationDesign'
            OR NAME = 'disinfectant.investigationDesign'
            OR NAME = 'grs.investigationDesign'
            OR NAME = 'lacquer.investigationDesign'
            OR NAME = 'antisediment.investigationDesign'
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200110_180739_update_records_of_table_authitem cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200110_180739_update_records_of_table_authitem cannot be reverted.\n";

        return false;
    }
    */
}
