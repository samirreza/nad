<?php

use yii\db\Migration;

class m180522_055306_add_isActive_to_supplier extends Migration
{
    public function up()
    {
        $this->addColumn('nad_supplier', 'isActive', $this->boolean()->notNull());
    }

    public function down()
    {
        $this->dropColumn('nad_supplier', 'isActive');
    }
}