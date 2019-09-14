<?php

use yii\db\Migration;

class m180912_135005_create_equipment_document_type_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('nad_equipment_document_type', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()
        ], $tableOptions);
        $this->insertDocumentTypes();
    }

    public function insertDocumentTypes()
    {
        $this->batchInsert(
            'nad_equipment_document_type',
            ['title'],
            [
                ['title' => 'معرفی مشخصات'],
                ['title' => 'دستور العمل نگهداری'],
                ['title' => 'دستور العمل حمل'],
                ['title' => 'دستور العمل نصب'],
                ['title' => 'دستور العمل بهره برداری'],
                ['title' => 'دستور العمل کنترل'],
                ['title' => 'دستور العمل سرویس'],
                ['title' => 'دستور العمل تعمیر'],
                ['title' => 'لیست قطعات یدکی'],
                ['title' => 'لیست حداقل انبار'],
                ['title' => 'نقشه انفجاری'],
                ['title' => 'نقشه مونتاژ'],
                ['title' => 'نقشه قطعات'],
                ['title' => 'نقشه مدل'],
                ['title' => 'نقشه اتصالات'],
                ['title' => 'لیست قطعات']
            ]
        );
    }

    public function safeDown()
    {
        $this->dropTable('nad_equipment_document_type');
    }
}
