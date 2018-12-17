<?php

use yii\db\Migration;

class m181217_173423_change_material_tables_name extends Migration
{
    public function safeUp()
    {
        $this->renameTable('nad_material_type', 'nad_research_material');
        $this->renameTable(
            'nad_material_type_category',
            'nad_research_material_category'
        );
        $this->dropForeignKey('nad_material_type_FK1', 'nad_research_material');
        $this->addForeignKey(
            'FK_nad_research_material_categoryId',
            'nad_research_material',
            'categoryId',
            'nad_research_material_category',
            'id'
        );
    }

    public function safeDown()
    {
        echo "m181217_173423_change_material_tables_name cannot be reverted.\n";
        return false;
    }
}
