<?php

use yii\db\Migration;

class m180827_112144_add_tree_fields_to_typecategory extends Migration
{
    public function up()
    {
        $this->addColumn(
            'nad_equipment_type_category',
            'tree',
            $this->integer()
        );
        $this->addColumn(
            'nad_equipment_type_category',
            'lft',
            $this->integer()->notNull()
        );
        $this->addColumn(
            'nad_equipment_type_category',
            'rgt',
            $this->integer()->notNull()
        );
        $this->addColumn(
            'nad_equipment_type_category',
            'depth',
            $this->integer()->notNull()
        );
    }

    public function down()
    {
        $this->dropColumn('nad_equipment_type_category', 'tree');
        $this->dropColumn('nad_equipment_type_category', 'lft');
        $this->dropColumn('nad_equipment_type_category', 'rgt');
        $this->dropColumn('nad_equipment_type_category', 'depth');
    }
}
