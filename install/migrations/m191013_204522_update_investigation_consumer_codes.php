<?php

use yii\db\Migration;

/**
 * Class m191013_204522_update_investigation_consumer_codes
 */
class m191013_204522_update_investigation_consumer_codes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $codes = [
            'SR' => 'sedimentation',
            'SF' => 'filter',
            'CF' => 'cartridge',
            'RO' => 'ro',
            'MB' => 'microbial'
        ];

        foreach ($codes as $key => $value) {
            $this->execute("
            UPDATE `nad_investigation_source`
            SET consumer = 'nad\\\\process\\\\ird\\\\{$value}\\\\investigation\\\\source\\\\models\\\\Source'
            WHERE
                consumer = '{$key}';

            UPDATE `nad_investigation_source_category`
            SET consumer = 'nad\\\\process\\\\ird\\\\{$value}\\\\investigation\\\\source\\\\models\\\\Category'
            WHERE
                consumer = '{$key}';

            UPDATE `nad_investigation_proposal`
            SET consumer = 'nad\\\\process\\\\ird\\\\{$value}\\\\investigation\\\\proposal\\\\models\\\\Proposal'
            WHERE
                consumer = '{$key}';

            UPDATE `nad_investigation_method`
            SET consumer = 'nad\\\\process\\\\ird\\\\{$value}\\\\investigation\\\\method\\\\models\\\\Method'
            WHERE
                consumer = '{$key}';

            UPDATE `nad_investigation_report`
            SET consumer = 'nad\\\\process\\\\ird\\\\{$value}\\\\investigation\\\\report\\\\models\\\\Report'
            WHERE
                consumer = '{$key}';

            UPDATE `nad_investigation_reference`
            SET consumer = 'nad\\\\process\\\\ird\\\\{$value}\\\\investigation\\\\reference\\\\models\\\\Reference'
            WHERE
                consumer = '{$key}';
            ");
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191013_204522_update_investigation_consumer_codes cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191013_204522_update_investigation_consumer_codes cannot be reverted.\n";

        return false;
    }
    */
}
