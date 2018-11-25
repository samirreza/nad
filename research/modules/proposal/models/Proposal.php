<?php

namespace nad\research\modules\proposal\models;

use core\behaviors\TimestampBehavior;
use nad\research\common\models\BaseReasearch;
use extensions\tag\behaviors\TaggableBehavior;
use nad\research\modules\expert\models\Expert;
use nad\research\modules\source\models\Source;
use extensions\i18n\validators\JalaliDateToTimestamp;
use nad\extensions\comment\behaviors\CommentBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\extensions\documentation\behaviors\DocumentationBehavior;

class Proposal extends BaseReasearch
{
    const STATUS_READY_FOR_PROJECT = 7;

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            'Documentation' => DocumentationBehavior::class,
            'Tags' => [
                'class' => TaggableBehavior::class,
                'moduleId' => 'proposal'
            ],
            'Comments' => [
                'class' => CommentBehavior::class,
                'moduleId' => 'proposal'
            ]
        ];
    }

    public function rules()
    {
        return [
            [
                [
                    'title',
                    'researcherName',
                    'presentationDate',
                    'necessity',
                    'mainPurpose',
                    'secondaryPurpose'
                ],
                'required'
            ],
            [
                [
                    'presentationDate',
                    'sessionDate'
                ],
                JalaliDateToTimestamp::class,
                'when' => function ($model, $attribute) {
                    return $model->$attribute !== $model->getOldAttribute($attribute);
                }
            ],
            [['title', 'researcherName'], 'string', 'max' => 255],
            [['necessity', 'mainPurpose', 'secondaryPurpose', 'proceedings'], 'string'],
            [
                ['necessity', 'mainPurpose', 'secondaryPurpose', 'proceedings'],
                FarsiCharactersValidator::class
            ],
            ['tags', 'safe'],
            ['tags', 'validateTagsCount', 'skipOnEmpty' => false],
            [
                'expertId',
                'exist',
                'targetClass' => Expert::class,
                'targetAttribute' => ['expertId' => 'id']
            ],
            [
                'sourceId',
                'exist',
                'targetClass' => Source::class,
                'targetAttribute' => ['sourceId' => 'id']
            ]
        ];
    }

    public function validateTagsCount($model, $attribute)
    {
        if (count($this->tags) < 3) {
            $this->addError(
                'tags',
                'تعداد کلید واژه ها باید حداقل ۳ عدد باشد.'
            );
        }
    }

    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'title' => 'عنوان',
            'researcherName' => 'نام محقق',
            'presentationDate' => 'تاریخ ارائه',
            'necessity' => 'ضرورت اجرای طرح',
            'mainPurpose' => 'هدف اصلی',
            'secondaryPurpose' => 'هدف فرعی',
            'deliverToManagerDate' => 'تاریخ تحویل به مدیر',
            'sessionDate' => 'تاریخ جلسه توجیهی',
            'proceedings' => 'صورت جلسه',
            'expertId' => 'کارشناس',
            'status' => 'وضعیت',
            'createdAt' => 'تاریخ درج',
            'updatedAt' => 'آخرین بروزرسانی',
            'tags' => 'کلید واژه ها',
            'sourceId' => 'منشا'
        ];
    }

    public function getExpert()
    {
        return $this->hasOne(Expert::class, ['id' => 'expertId']);
    }

    public function getSource()
    {
        return $this->hasOne(Source::class, ['id' => 'sourceId']);
    }

    public static function tableName()
    {
        return 'nad_research_proposal';
    }

    public static function getStatusLables()
    {
        $statusLabels = array_merge(
            parent::getStatusLables(),
            [
                self::STATUS_READY_FOR_PROJECT => 'آماده برای انجام گزارش'
            ]
        );
        unset($statusLabels[self::STATUS_REJECTED]);
        return $statusLabels;
    }
}
