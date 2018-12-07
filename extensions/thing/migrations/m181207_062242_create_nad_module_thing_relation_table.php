<?php

use yii\db\Migration;

class m181207_062242_create_nad_module_thing_relation_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions =
                'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('nad_module_thing_relation', [
            'id' => $this->primaryKey(),
            'thingId' => $this->integer()->notNull(),
            'thingTypeId' => $this->integer()->notNull(),
            'modelId' => $this->integer()->notNull(),
            'modelClassName' => $this->string()->notNull(),
            'moduleId' => $this->string()->notNull()
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('nad_module_thing_relation');
    }
}
