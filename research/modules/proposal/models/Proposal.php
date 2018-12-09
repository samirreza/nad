<?php

namespace nad\research\modules\proposal\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use core\behaviors\TimestampBehavior;
use modules\user\backend\models\User;
use nad\research\common\models\BaseReasearch;
use extensions\tag\behaviors\TaggableBehavior;
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
                    'necessity',
                    'mainPurpose',
                    'secondaryPurpose'
                ],
                'required'
            ],
            [
                'sessionDate',
                JalaliDateToTimestamp::class,
                'when' => function ($model, $attribute) {
                    return $model->$attribute !== $model->getOldAttribute($attribute);
                }
            ],
            ['title', 'string', 'max' => 255],
            [['necessity', 'mainPurpose', 'secondaryPurpose', 'proceedings'], 'string'],
            [
                ['necessity', 'mainPurpose', 'secondaryPurpose', 'proceedings'],
                FarsiCharactersValidator::class
            ],
            ['tags', 'safe'],
            ['tags', 'validateTagsCount', 'skipOnEmpty' => false],
            ['expertUserId', 'integer'],
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
            'createdBy' => 'محقق',
            'necessity' => 'ضرورت اجرای طرح',
            'mainPurpose' => 'هدف اصلی',
            'secondaryPurpose' => 'اهدافص فرعی',
            'deliverToManagerDate' => 'تاریخ تحویل به مدیر',
            'sessionDate' => 'تاریخ جلسه توجیهی',
            'proceedings' => 'نتیجه برگزاری جلسه',
            'expertUserId' => 'کارشناس نگارش گزارش',
            'status' => 'وضعیت',
            'createdAt' => 'تاریخ ارائه',
            'updatedAt' => 'آخرین بروزرسانی',
            'tags' => 'کلید واژه ها',
            'sourceId' => 'منشا'
        ];
    }

    public function getResearcher()
    {
        return $this->hasOne(User::class, ['id' => 'createdBy']);
    }

    public function getSource()
    {
        return $this->hasOne(Source::class, ['id' => 'sourceId']);
    }

    public function canUserCreateProject()
    {
        if ($this->status == self::STATUS_READY_FOR_PROJECT) {
            if (Yii::$app->user->can('research.manage')) {
                return true;
            }
            return $this->expertUserId == Yii::$app->user->id;
        }
        return false;
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
                self::STATUS_READY_FOR_PROJECT => 'آماده برای نگارش گزارش'
            ]
        );
        unset($statusLabels[self::STATUS_REJECTED]);
        return $statusLabels;
    }
}
