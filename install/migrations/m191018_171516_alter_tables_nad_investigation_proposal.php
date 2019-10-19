<?php

use yii\db\Migration;

/**
 * Class m191018_171516_alter_tables_nad_investigation_proposal
 */
class m191018_171516_alter_tables_nad_investigation_proposal extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        ALTER TABLE `nad_investigation_proposal` ADD `methodDesc` TEXT AFTER `consumer`;

        ALTER TABLE `nad_investigation_proposal` ADD `estimatedCost` TEXT AFTER `consumer`;

        ALTER TABLE `nad_investigation_proposal` ADD `isArchived` INT NOT NULL DEFAULT '1' AFTER `consumer`;

        ALTER TABLE `nad_investigation_proposal` ADD `categoryId` INT NULL AFTER `isArchived`, ADD INDEX (`categoryId`);

        ALTER TABLE `nad_investigation_proposal`
            ADD COLUMN `userHolder` int(11) NULL AFTER `categoryId`;
        ");

        // add category table
        $this->createTable('nad_investigation_proposal_category', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'tree' => $this->integer(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull()
        ]);
        $this->addForeignKey(
            'nad_investigation_proposal_FK1',
            'nad_investigation_proposal',
            'categoryId',
            'nad_investigation_proposal_category',
            'id'
        );

        // add some extra columns
        $this->execute("
        ALTER TABLE `nad_investigation_proposal_category` ADD `consumer` varchar(255) COLLATE utf8_unicode_ci NOT NULL;
        ");



        // convert prev inserted records
        $this->execute("
        update nad_investigation_proposal set userHolder = 0 where `nad_investigation_proposal`.`STATUS` != 0 and `nad_investigation_proposal`.`STATUS` != 5 and `nad_investigation_proposal`.`STATUS` != 8; -- 0 = STATUS_INPROGRESS  ,  5 = STATUS_NEED_CORRECTION   ,  8 = STATUS_IN_NEXT_STEP

        update nad_investigation_proposal set userHolder = 1 where `nad_investigation_proposal`.`STATUS` = 0 or `nad_investigation_proposal`.`STATUS` = 5 or `nad_investigation_proposal`.`STATUS` = 8; -- 0 = STATUS_INPROGRESS  ,  5 = STATUS_NEED_CORRECTION   ,  8 = STATUS_IN_NEXT_STEP
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191018_171516_alter_tables_nad_investigation_proposal cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191018_171516_alter_tables_nad_investigation_proposal cannot be reverted.\n";

        return false;
    }
    */
}
