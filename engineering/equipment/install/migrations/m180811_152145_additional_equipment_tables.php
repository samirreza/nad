<?php

use yii\db\Migration;

class m180811_152145_additional_equipment_tables extends Migration
{
    public function up()
    {
        $this->createTable('nad_equipment_type_part', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'title' => $this->string(),
            'typeId' => $this->integer()->notNull()
        ]);

        $this->createTable('nad_equipment_type_part_model', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'title' => $this->string(),
            'partId' => $this->integer()->notNull(),
            'typeId' => $this->integer()->notNull()
        ]);

        $this->createTable('nad_equipment_type_fitting', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'title' => $this->string(),
            'typeId' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'nad_equipment_part_FK1',
            'nad_equipment_type_part',
            'typeId',
            'nad_equipment_type',
            'id'
        );

        $this->addForeignKey(
            'nad_equipment_model_FK2',
            'nad_equipment_type_part_model',
            'typeId',
            'nad_equipment_type',
            'id'
        );

        $this->addForeignKey(
            'nad_equipment_model_FK1',
            'nad_equipment_type_part_model',
            'partId',
            'nad_equipment_type_part',
            'id'
        );

        $this->addForeignKey(
            'nad_equipment_fitting_FK1',
            'nad_equipment_type_fitting',
            'typeId',
            'nad_equipment_type',
            'id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('nad_equipment_type_part_model');
        $this->dropTable('nad_equipment_type_part');
        $this->dropTable('nad_equipment_type_fitting');
    }
}
