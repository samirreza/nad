<?php

use yii\db\Migration;

/**
 * Class m200612_180544_fill_lookup_table
 */
class m200612_180544_fill_lookup_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        INSERT INTO `lookup` (`id`, `name`, `type`, `code`, `position`, `extra`) VALUES (NULL, 'پیش نمایش', 'nad.rla.request.Type', '1', '1', NULL), (NULL, 'تک مدرک', 'nad.rla.request.Type', '2', '2', NULL);

        INSERT INTO `lookup` (`id`, `name`, `type`, `code`, `position`, `extra`) VALUES
        (NULL, 'در دست بررسی', 'nad.rla.request.Status', '1', '1', NULL),
        (NULL, 'تایید شده توسط مدیر', 'nad.rla.request.Status', '2', '2', NULL),
        (NULL, 'رد شده توسط مدیر', 'nad.rla.request.Status', '3', '3', NULL),
        (NULL, 'تایید قطعی', 'nad.rla.request.Status', '4', '4', NULL),
        (NULL, 'رد قطعی', 'nad.rla.request.Status', '5', '5', NULL);


        INSERT INTO `lookup` (`id`, `name`, `type`, `code`, `position`, `extra`) VALUES (NULL, 'خوانده شده', 'nad.rla.request.IsRead', '1', '1', NULL), (NULL, 'خوانده نشده', 'nad.rla.request.IsRead', '2', '2', NULL)
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200612_180544_fill_lookup_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200612_180544_fill_lookup_table cannot be reverted.\n";

        return false;
    }
    */
}
