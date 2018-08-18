<?php

use yii\db\Migration;

class m180521_055305_add_email_to_phonebook extends Migration
{
    public function up()
    {
        $this->addColumn('nad_supplier_phonebook', 'email', $this->string()->null());
    }

    public function down()
    {
        $this->dropColumn('nad_supplier_phonebook', 'email');
    }
}