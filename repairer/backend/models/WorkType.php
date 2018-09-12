<?php

namespace modules\nad\repairer\backend\models;

class WorkType extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'nad_repairer_work_type';
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
        return $this->hasMany(Repairer::class, ['id' => 'repairerId'])
            ->viaTable('nad_repairer_work_type_relation', ['workId' => 'id']);
    }
}