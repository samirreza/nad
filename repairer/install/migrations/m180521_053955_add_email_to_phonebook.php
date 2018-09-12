<?php

use yii\db\Migration;

class m180521_053955_add_email_to_phonebook extends Migration
{
    public function up()
    {
        $this->addColumn('nad_repairer_phonebook', 'email', $this->string()->null());
    }

    public function down()
    {
        $this->dropColumn('nad_repairer_phonebook', 'email');
    }
}