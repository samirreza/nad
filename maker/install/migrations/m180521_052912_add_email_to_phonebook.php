<?php

use yii\db\Migration;

class m180521_052912_add_email_to_phonebook extends Migration
{
    public function up()
    {
        $this->addColumn('nad_maker_phonebook', 'email', $this->string()->null());
    }

    public function down()
    {
        $this->dropColumn('nad_maker_phonebook', 'email');
    }
}