<?php

use yii\db\Migration;

class m180428_052144_add_phone_fax_to_supplier extends Migration
{
    public function up()
    {
        $this->addColumn('nad_supplier', 'phone', $this->string());
        $this->addColumn('nad_supplier', 'fax', $this->string());
    }

    public function down()
    {
        $this->dropColumn('nad_supplier', 'phone');
        $this->dropColumn('nad_supplier', 'fax');
    }
}
