<?php

use yii\db\Migration;

class m181115_191047_create_comment_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions =
                'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'content' => $this->text()->notNull(),
            'insertedBy' => $this->integer(),
            'insertedAt' => $this->integer()->notNull(),
            'moduleId' => $this->string()->notNull(),
            'modelClassName' => $this->string()->notNull(),
            'modelId' => $this->integer()->notNull()
        ], $tableOptions);

        $this->createIndex(
            'IDX_comment_moduleId',
            'comment',
            'moduleId'
        );

        $this->createIndex(
            'IDX_comment_ownerId',
            'comment',
            'modelId'
        );

        $this->createIndex(
            'IDX_comment_ownerClassName',
            'comment',
            'modelClassName'
        );

        $this->addForeignKey(
            'FK_comment_user_insertedBy',
            'comment',
            'insertedBy',
            'user',
            'id',
            'SET NULL',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('comment');
    }
}
