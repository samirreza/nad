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
            ResourceBehavior::class
        ];
    }

    public function rules()
    {
        return [
            [
                [
                    'title',
                    'reason',
                    'necessity',
                    'reasons'
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
            [['reason', 'necessity', 'proceedings'], 'string'],
            [
                ['reason', 'necessity', 'proceedings'],
                FarsiCharactersValidator::class
            ],
            [['tags', 'experts', 'resources'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'title' => 'عنوان',
            'createdBy' => 'پیشنهاد دهنده',
            'reason' => 'دلایل طرح موضوع',
            'necessity' => 'ضرورت های طرح موضوع',
            'deliverToManagerDate' => 'تاریخ تحویل به مدیر',
            'sessionDate' => 'تاریخ جلسه توجیهی',
            'proceedings' => 'نتیجه برگزاری جلسه',
            'status' => 'وضعیت',
            'createdAt' => 'تاریخ پیشنهاد',
            'updatedAt' => 'آخرین بروزرسانی',
            'reasons' => 'علل پیدایش',
            'tags' => 'کلید واژه ها',
            'experts' => 'کارشناسان نگارش پروپوزال',
            'resources' => 'منابع'
        ];
    }

    public function getRecommender()
    {
        return $this->hasOne(User::class, ['id' => 'createdBy']);
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

    public function canUserUpdateOrDelete()
    {
        if ($this->status == self::STATUS_PROPOSAL_CREATED) {
            return false;
        }
        return parent::canUserUpdateOrDelete();
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
