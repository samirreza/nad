<?php

namespace nad\research\modules\proposal\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use core\behaviors\TimestampBehavior;
use modules\user\backend\models\User;
use core\behaviors\PreventDeleteBehavior;
use nad\research\common\models\BaseResearch;
use extensions\tag\behaviors\TaggableBehavior;
use nad\research\modules\source\models\Source;
use nad\research\modules\project\models\Project;
use extensions\tag\behaviors\TaggableQueryBehavior;
use extensions\i18n\validators\JalaliDateToTimestamp;
use nad\extensions\comment\behaviors\CommentBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\research\modules\resource\behaviors\ResourceBehavior;

class Proposal extends BaseResearch
{
    const STATUS_READY_FOR_PROJECT = 7;
    const STATUS_PROJECT_CREATED = 8;

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
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
            ],
            [
                'class' => PreventDeleteBehavior::class,
                'relations' => [
                    [
                        'relationMethod' => 'getProject',
                        'relationName' => 'گزارش'
                    ]
                ]
            ],
            ResourceBehavior::class
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
            [['tags', 'resources'], 'safe'],
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
            'secondaryPurpose' => 'اهداف فرعی',
            'deliverToManagerDate' => 'تاریخ تحویل به مدیر',
            'sessionDate' => 'تاریخ جلسه توجیهی',
            'proceedings' => 'نتیجه برگزاری جلسه',
            'expertUserId' => 'کارشناس نگارش گزارش',
            'status' => 'وضعیت',
            'createdAt' => 'تاریخ ارائه',
            'updatedAt' => 'آخرین بروزرسانی',
            'tags' => 'کلید واژه ها',
            'sourceId' => 'منشا',
            'resources' => 'منابع'
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

    public function getProject()
    {
        return $this->hasOne(Project::class, ['proposalId' => 'id']);
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

    public function canUserUpdateOrDelete()
    {
        if ($this->status == self::STATUS_PROJECT_CREATED) {
            return false;
        }
        return parent::canUserUpdateOrDelete();
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $this->source->changeStatus(Source::STATUS_PROPOSAL_CREATED);
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public static function find()
    {
        $query = parent::find();
        $query->attachBehavior(
            'TaggableQueryBehavior',
            [
                'class' => TaggableQueryBehavior::class,
                'modelShortClassName' => (new \ReflectionClass(self::class))
                    ->getShortName(),
                'moduleId' => 'proposal'
            ]
        );
        return $query;
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
                self::STATUS_READY_FOR_PROJECT => 'آماده برای نگارش گزارش',
                self::STATUS_PROJECT_CREATED => 'در حال تکمیل گزارش'
            ]
        );
        unset($statusLabels[self::STATUS_REJECTED]);
        return $statusLabels;
    }
}
