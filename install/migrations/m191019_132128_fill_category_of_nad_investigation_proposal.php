<?php

use yii\db\Migration;

/**
 * Class m191019_132128_fill_category_of_nad_investigation_proposal
 */
class m191019_132128_fill_category_of_nad_investigation_proposal extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        update nad_investigation_proposal set categoryId = 1
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191019_132128_fill_category_of_nad_investigation_proposal cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191019_132128_fill_category_of_nad_investigation_proposal cannot be reverted.\n";

        return false;
    }
    */
}
