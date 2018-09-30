<?php

namespace modules\nad\equipment\modules\document\models;

class DocumentType extends \yii\db\ActiveRecord
{
    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'title' => 'نوع مدرک'
        ];
    }

    public function getDocuments()
    {
        return $this->hasMany(Document::class, ['documentTypeId' => 'id']);
    }

    public static function tableName()
    {
        return 'nad_equipment_document_type';
    }
}
