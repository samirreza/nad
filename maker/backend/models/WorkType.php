<?php

namespace modules\nad\maker\backend\models;

class WorkType extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'nad_maker_work_type';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'title' => 'نوع کار و حرفه',
            'createdAt' => 'تاریخ ایجاد',
            'updatedAt' => 'آخرین بروزرسانی',
        ];
    }

    public function getPosts()
    {
        return $this->hasMany(Maker::class, ['id' => 'makerId'])
            ->viaTable('nad_maker_work_type_relation', ['workId' => 'id']);
    }
}