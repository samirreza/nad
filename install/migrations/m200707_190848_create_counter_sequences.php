<?php

use yii\db\Migration;

/**
 * Class m200707_190848_create_counter_sequences
 */
class m200707_190848_create_counter_sequences extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        -- nad_eng_device_category_document
        CREATE SEQUENCE seq_nedcd_counter START WITH 1 INCREMENT BY 1;

        -- nad_eng_device_part_document
        CREATE SEQUENCE seq_nedpd_counter START WITH 1 INCREMENT BY 1;

        -- nad_eng_device_part_instance_document
        CREATE SEQUENCE seq_nedpid_counter START WITH 1 INCREMENT BY 1;

        -- nad_eng_device_document_group_document
        CREATE SEQUENCE seq_neddgd_counter START WITH 1 INCREMENT BY 1;

        -- nad_eng_device_instance_document
        CREATE SEQUENCE seq_nedid_counter START WITH 1 INCREMENT BY 1;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200707_190848_create_counter_sequences cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200707_190848_create_counter_sequences cannot be reverted.\n";

        return false;
    }
    */
}
