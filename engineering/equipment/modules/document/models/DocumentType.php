<?php

namespace nad\engineering\equipment\modules\document\models;

use yii\db\ActiveRecord;

class DocumentType extends ActiveRecord
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
