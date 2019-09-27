<?php

use yii\db\Migration;

/**
 * Class m190927_215359_alter_table_nad_investigation_source_category
 */
class m190927_215359_alter_table_nad_investigation_source_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        ALTER TABLE `nad_investigation_source` ADD `categoryId` INT NULL AFTER `isArchived`, ADD INDEX (`categoryId`);
        ');

        $this->createTable('nad_investigation_source_category', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'tree' => $this->integer(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'nad_investigation_source_FK1',
            'nad_investigation_source',
            'categoryId',
            'nad_investigation_source_category',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190927_215359_alter_table_nad_investigation_source_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190927_215359_alter_table_nad_investigation_source_category cannot be reverted.\n";

        return false;
    }
    */
}
