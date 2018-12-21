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
                    'code',
                    'necessity',
                    'mainPurpose',
                    'secondaryPurpose'
                ],
                'required'
            ],
            ['title', 'string', 'max' => 255],
            ['code', 'string', 'max' => 4, 'min' => 4],
            [['necessity', 'mainPurpose', 'secondaryPurpose', 'proceedings'], 'string'],
            [['tags', 'resources'], 'safe'],
            [['title', 'code'], 'trim'],
            ['expertUserId', 'integer'],
            ['tags', 'validateTagsCount', 'skipOnEmpty' => false],
            [
                ['necessity', 'mainPurpose', 'secondaryPurpose', 'proceedings'],
                FarsiCharactersValidator::class
            ],
            [
                'sessionDate',
                JalaliDateToTimestamp::class,
                'when' => function ($model, $attribute) {
                    return $model->$attribute !== $model->getOldAttribute($attribute);
                }
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
            'title' => 'عنوان',
            'code' => 'کد موضوع',
            'uniqueCode' => 'شناسه',
            'createdBy' => 'محقق',
            'createdAt' => 'تاریخ ارائه',
            'necessity' => 'ضرورت اجرای طرح',
            'mainPurpose' => 'هدف اصلی',
            'secondaryPurpose' => 'اهداف فرعی',
            'resources' => 'منابع',
            'tags' => 'کلید واژه ها',
            'sourceId' => 'منشا',
            'deliverToManagerDate' => 'تاریخ تحویل به مدیر',
            'sessionDate' => 'تاریخ جلسه توجیهی',
            'proceedings' => 'نتیجه برگزاری جلسه',
            'expertUserId' => 'کارشناس نگارش گزارش',
            'status' => 'وضعیت',
            'updatedAt' => 'آخرین بروزرسانی',
        ];
    }

    public function beforeValidate()
    {
        if (!parent::beforeValidate()) {
            return false;
        }
        $this->code = strtoupper($this->code);
        return true;
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if ($insert) {
            $this->lastCode = 1;
        } elseif (
            $this->oldAttributes['status'] == self::STATUS_NEED_CORRECTION &&
            $this->status == self::STATUS_DELIVERED_TO_MANAGER
        ) {
            $this->lastCode = $this->lastCode + 1;
        }
        $this->setUniqueCode();
        return true;
    }

    public function setUniqueCode()
    {
        $this->uniqueCode = $this->code . '.' .
            str_pad($this->lastCode, 3, '0', STR_PAD_LEFT);
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
