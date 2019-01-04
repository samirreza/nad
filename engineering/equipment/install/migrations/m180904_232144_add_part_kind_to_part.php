<?php

use yii\db\Migration;

class m180904_232144_add_part_kind_to_part extends Migration
{
    public function up()
    {
        $this->addColumn(
            'nad_equipment_type_part',
            'kind',
            $this->smallInteger()->defaultValue(1)
        );
    }

    public function down()
    {
        $this->dropColumn('nad_equipment_type_part', 'kind');
    }
}
