<?php

use yii\db\Migration;

class m191221_065622_add_code_column_to_nad_investigation_source_reason extends Migration
{
    public function safeUp()
    {
        Yii::$app->db->createCommand()->delete('nad_investigation_source_reason')->execute();
        $this->addColumn(
            'nad_investigation_source_reason',
            'code',
            $this->string()->notNull()
        );

        $this->batchInsert(
            'nad_investigation_source_reason',
            ['title', 'code'],
            [
                ['title' => 'ایده', 'code' => 'I'],
                ['title' => 'سوال', 'code' => 'Q'],
                ['title' => 'تجربه', 'code' => 'E'],
                ['title' => 'گزارش', 'code' => 'R'],
                ['title' => 'مشکلات', 'code' => 'P'],
                ['title' => 'غیره', 'code' => 'O']
            ]
        );
    }

    public function safeDown()
    {
        echo "m181221_065622_add_code_column_to_nad_research_source_reason cannot be reverted.\n";
        return false;
    }
}
