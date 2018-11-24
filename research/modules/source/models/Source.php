<?php

namespace nad\research\modules\source\models;

use yii\behaviors\BlameableBehavior;
use core\behaviors\TimestampBehavior;
use nad\research\common\models\BaseReasearch;
use extensions\tag\behaviors\TaggableBehavior;
use nad\research\modules\expert\models\Expert;
use extensions\i18n\validators\JalaliDateToTimestamp;
use nad\extensions\comment\behaviors\CommentBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\research\modules\source\behaviors\ReasonsBehavior;
use nad\extensions\documentation\behaviors\DocumentationBehavior;

class Source extends BaseReasearch
{
    const STATUS_READY_FOR_PROPOSAL = 7;

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
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'createdBy',
                'updatedByAttribute' => false
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
            'tags' => 'کلید واژه ها'
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

    public static function tableName()
    {
        return 'nad_research_source';
    }

    public static function getStatusLables()
    {
        return array_merge(
            parent::getStatusLables(),
            [
                self::STATUS_READY_FOR_PROPOSAL => 'آماده برای تهیه پروپوزال'
            ]
        );
    }
}
