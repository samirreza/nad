<?php

use yii\db\Migration;

class m181122_054900_create_expert_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions =
                'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('nad_research_expert', [
            'id' => $this->primaryKey(),
            'userId' => $this->integer()->notNull(),
            'createdAt' => $this->integer()->notNull(),
            'updatedAt' => $this->integer()->notNull()
        ], $tableOptions);

        $this->addForeignKey(
            'FK_nad_research_expert_user',
            'nad_research_expert',
            'userId',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('nad_research_expert');
    }
}
