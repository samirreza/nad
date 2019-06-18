<?php

use yii\db\Migration;

class m190616_164322_create_nad_investigation_method_tables extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('nad_investigation_method', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'englishTitle' => $this->string(),
            'createdAt' => $this->integer()->notNull(),
            'abstract' => $this->text()->notNull(),
            'description' => $this->text(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'createdBy' => $this->integer()->notNull(),
            'updatedAt' => $this->integer()->notNull(),
            'deliverToManagerDate' => $this->integer(),
            'sessionDate' => $this->integer(),
            'proceedings' => $this->text(),
            'negotiationResult' => $this->text(),
            'lastCodeNumber' => $this->integer()->notNull(),
            'uniqueCode' => $this->string()->notNull(),
            'consumer' => $this->string()->notNull()
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('nad_investigation_method');
    }
}
