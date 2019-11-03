<?php

use yii\db\Migration;

/**
 * Class m191103_173156_create_table_nad_investigation_method_category
 */
class m191103_173156_create_table_nad_investigation_method_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        ALTER TABLE `nad_investigation_method` ADD `isArchived` INT NULL AFTER `consumer`;
        ');
        $this->execute('
        ALTER TABLE `nad_investigation_method` ADD `categoryId` INT NULL AFTER `consumer`, ADD INDEX (`categoryId`);
        ');

        $this->createTable('nad_investigation_method_category', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'tree' => $this->integer(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
            'consumer' => $this->string()->notNull(),
        ]);

        $this->addForeignKey(
            'nad_investigation_method_FK1',
            'nad_investigation_method',
            'categoryId',
            'nad_investigation_method_category',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191103_173156_create_table_nad_investigation_method_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191103_173156_create_table_nad_investigation_method_category cannot be reverted.\n";

        return false;
    }
    */
}
