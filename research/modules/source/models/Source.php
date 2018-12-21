<?php

namespace nad\research\modules\source\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use core\behaviors\TimestampBehavior;
use modules\user\backend\models\User;
use core\behaviors\PreventDeleteBehavior;
use nad\research\common\models\BaseResearch;
use extensions\tag\behaviors\TaggableBehavior;
use nad\research\modules\expert\models\Expert;
use nad\research\modules\proposal\models\Proposal;
use extensions\i18n\validators\JalaliDateToTimestamp;
use nad\extensions\comment\behaviors\CommentBehavior;
use nad\research\common\behaviors\SettingCodeBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\research\modules\source\behaviors\ExpertsBehavior;
use nad\research\modules\source\behaviors\ReasonsBehavior;
use nad\research\modules\resource\behaviors\ResourceBehavior;

class Source extends BaseResearch
{
    const STATUS_READY_FOR_PROPOSAL = 7;
    const STATUS_PROPOSAL_CREATED = 8;

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            'Reasons' => ReasonsBehavior::class,
            'Experts' => ExpertsBehavior::class,
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
            ],
            [
                'class' => PreventDeleteBehavior::class,
                'relations' => [
                    [
                        'relationMethod' => 'getProposals',
                        'relationName' => 'پروپوزال'
                    ]
                ]
            ],
            ResourceBehavior::class,
            [
                'class' => SettingCodeBehavior::class,
                'determinativeColumn' => 'mainReasonId'
            ]
        ];
    }

    public function rules()
    {
        return [
            [
                [
                    'title',
                    'code',
                    'reason',
                    'necessity',
                    'reasons',
                    'mainReasonId'
                ],
                'required'
            ],
            [['title', 'code'], 'trim'],
            ['title', 'string', 'max' => 255],
            ['code', 'string', 'max' => 4, 'min' => 4],
            [['reason', 'necessity', 'proceedings'], 'string'],
            [['tags', 'experts', 'resources'], 'safe'],
            [
                'sessionDate',
                JalaliDateToTimestamp::class,
                'when' => function ($model, $attribute) {
                    return $model->$attribute !== $model->getOldAttribute($attribute);
                }
            ],
            [
                ['title', 'reason', 'necessity', 'proceedings'],
                FarsiCharactersValidator::class
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'عنوان',
            'code' => 'کد موضوع',
            'uniqueCode' => 'شناسه',
            'createdBy' => 'پیشنهاد دهنده',
            'createdAt' => 'تاریخ پیشنهاد',
            'reason' => 'دلایل طرح موضوع',
            'necessity' => 'ضرورت های طرح موضوع',
            'reasons' => 'علل پیدایش',
            'mainReasonId' => 'علت اصلی',
            'resources' => 'منابع',
            'tags' => 'کلید واژه ها',
            'deliverToManagerDate' => 'تاریخ تحویل به مدیر',
            'sessionDate' => 'تاریخ جلسه توجیهی',
            'proceedings' => 'نتیجه برگزاری جلسه',
            'experts' => 'کارشناسان نگارش پروپوزال',
            'status' => 'وضعیت',
            'updatedAt' => 'آخرین بروزرسانی'
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
        $this->setUniqueCode();
        return true;
    }

    public function setUniqueCode()
    {
        $this->uniqueCode = $this->mainReason->code . '.'
            . $this->code . '.' . $this->lastCodePart;
    }

    public function getRecommender()
    {
        return $this->hasOne(User::class, ['id' => 'createdBy']);
    }

    public function getMainReason()
    {
        return $this->hasOne(SourceReason::class, ['id' => 'mainReasonId']);
    }

    public function getReasonsQuery()
    {
        return $this->hasMany(SourceReason::class, ['id' => 'reasonId'])
            ->viaTable('nad_research_source_reason_relation', ['sourceId' => 'id']);
    }

    public function getExpertsQuery()
    {
        return $this->hasMany(Expert::class, ['id' => 'expertId'])
            ->viaTable('nad_research_proposal_expert_relation', ['sourceId' => 'id']);
    }

    public function getProposals()
    {
        return $this->hasMany(Proposal::class, ['sourceId' => 'id']);
    }

    public function canUserUpdateOrDelete()
    {
        if ($this->status == self::STATUS_PROPOSAL_CREATED) {
            return false;
        }
        return parent::canUserUpdateOrDelete();
    }

    public function canUserCreateProposal()
    {
        if ($this->status == self::STATUS_READY_FOR_PROPOSAL) {
            if (Yii::$app->user->can('research.manage')) {
                return true;
            }
            return $this->hasExpert(Yii::$app->user->id);
        }
        return false;
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
                self::STATUS_READY_FOR_PROPOSAL => 'آماده برای تهیه پروپوزال',
                self::STATUS_PROPOSAL_CREATED => 'در حال تکمیل پروپوزال'
            ]
        );
    }
}
