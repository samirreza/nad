<?php

namespace modules\nad\equipment\modules\document\models;

class DocumentType extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'nad_equipment_document_type';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'title' => 'نوع مدرک',
            'createdAt' => 'تاریخ ایجاد',
            'updatedAt' => 'آخرین بروزرسانی',
        ];
    }

    public function getDocs()
    {
        return $this->hasMany(Document::class, ['documentId' => 'id']);
    }
}