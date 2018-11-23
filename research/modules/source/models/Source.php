<?php

namespace nad\research\modules\source\models;

use core\behaviors\TimestampBehavior;
use extensions\tag\behaviors\TaggableBehavior;
use nad\research\modules\expert\models\Expert;
use extensions\i18n\validators\JalaliDateToTimestamp;
use nad\extensions\comment\behaviors\CommentBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\research\modules\source\behaviors\ReasonsBehavior;
use nad\extensions\documentation\behaviors\DocumentationBehavior;

class Source extends \yii\db\ActiveRecord
{
    const STATUS_REJECTED = 0;
    const STATUS_NEED_CORRECTION = 1;
    const STATUS_INPROGRESS = 2;
    const STATUS_DELIVERED_TO_MANAGER = 3;
    const STATUS_WAITING_FOR_MEETING = 4;
    const STATUS_MEETING_HELD = 5;
    const STATUS_ACCEPTED = 6;
    const STATUS_CREATE_PROPOSAL = 7;

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            'Reasons' => ReasonsBehavior::class,
            'Documentation' => DocumentationBehavior::class,
            'Tags' => [
                'class' => TaggableBehavior::class,
                'moduleId' => 'source'
            ],
            'Comments' => [
                'class' => CommentBehavior::class,
                'moduleId' => 'source'
            ]
        ];
    }

    public function rules()
    {
        return [
            [
                [
                    'title',
                    'recommenderName',
                    'recommendationDate',
                    'reason',
                    'necessity',
                    'reasons'
                ],
                'required'
            ],
            [
                [
                    'recommendationDate',
                    'sessionDate'
                ],
                JalaliDateToTimestamp::class,
                'when' => function ($model, $attribute) {
                    return $model->$attribute !== $model->getOldAttribute($attribute);
                }
            ],
            [['title', 'recommenderName'], 'string', 'max' => 255],
            [['reason', 'necessity', 'proceedings'], 'string'],
            [
                ['reason', 'necessity', 'proceedings'],
                FarsiCharactersValidator::class
            ],
            ['tags', 'safe'],
            [
                'expertId',
                'exist',
                'targetClass' => Expert::class,
                'targetAttribute' => ['expertId' => 'id']
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'title' => 'عنوان',
            'recommenderName' => 'نام پیشنهاد دهنده',
            'recommendationDate' => 'تاریخ پیشنهاد',
            'reason' => 'دلایل طرح موضوع',
            'necessity' => 'ضرورت های طرح موضوع',
            'deliverToManagerDate' => 'تاریخ تحویل به مدیر',
            'sessionDate' => 'تاریخ جلسه توجیهی',
            'proceedings' => 'صورت جلسه',
            'expertId' => 'کارشناس',
            'status' => 'وضعیت',
            'createdAt' => 'تاریخ درج',
            'updatedAt' => 'آخرین بروزرسانی',
            'reasons' => 'علل پیدایش',
            'tags' => 'برچسب ها'
        ];
    }

    public function getExpert()
    {
        return $this->hasOne(Expert::class, ['id' => 'expertId']);
    }

    public function getReasonsQuery()
    {
        return $this->hasMany(SourceReason::class, ['id' => 'reasonId'])
            ->viaTable('nad_research_source_reason_relation', ['sourceId' => 'id']);
    }

    public function changeStatus($newStatus)
    {
        $this->status = $newStatus;
        $this->save();
    }

    public function canSetSessionDate()
    {
        return $this->status == self::STATUS_DELIVERED_TO_MANAGER ||
            $this->status == self::STATUS_WAITING_FOR_MEETING;
    }

    public static function tableName()
    {
        return 'nad_research_source';
    }

    public static function getStatusLables()
    {
        return [
            self::STATUS_REJECTED => 'رد شده',
            self::STATUS_INPROGRESS => 'در حال تکمیل',
            self::STATUS_NEED_CORRECTION => 'نیازمند اصلاح',
            self::STATUS_DELIVERED_TO_MANAGER => 'ارسال شده به مدیر',
            self::STATUS_WAITING_FOR_MEETING => 'در انتظار جلسه',
            self::STATUS_MEETING_HELD => 'جلسه برگزار شد',
            self::STATUS_ACCEPTED => 'پذیرفته شد',
            self::STATUS_CREATE_PROPOSAL => 'در حال تهیه پروپوزال'
        ];
    }
}
