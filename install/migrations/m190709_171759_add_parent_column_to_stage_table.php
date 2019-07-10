<?php

use yii\db\Migration;

/**
 * Handles adding parent to table `{{%stage}}`.
 */
class m190709_171759_add_parent_column_to_stage_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('ALTER TABLE nad_eng_stage ADD parentId INT NULL AFTER title');
        $this->addForeignKey(
            'nad_eng_stage_FK2',
            'nad_eng_stage',
            'parentId',
            'nad_eng_stage',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute('ALTER TABLE nad_eng_stage DROP parentId');
        $this->dropForeignKey('nad_eng_stage_FK2');
    }
}
