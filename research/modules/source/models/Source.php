<?php

namespace nad\research\modules\source\models;

use Yii;
use nad\office\modules\expert\models\Expert;
use nad\research\common\models\BaseResearch;
use extensions\tag\behaviors\TaggableBehavior;
use nad\research\common\behaviors\CodeNumerator;
use nad\research\modules\proposal\models\Proposal;
use extensions\tag\behaviors\TaggableQueryBehavior;
use extensions\i18n\validators\JalaliDateToTimestamp;
use nad\extensions\comment\behaviors\CommentBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\research\modules\source\behaviors\ExpertsBehavior;
use nad\research\modules\source\behaviors\ReasonsBehavior;

class Source extends BaseResearch
{
    const SCENARIO_SET_EXPERTS = 'setExperts';

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
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
                    'class' => CodeNumerator::class,
                    'determinativeColumn' => 'mainReasonId'
                ]
            ]
        );
    }

    public function rules()
    {
        return [
            [
                [
                    'title',
                    'code',
                    'createdAt',
                    'reason',
                    'necessity',
                    'reasons',
                    'mainReasonId'
                ],
                'required'
            ],
            ['sessionDate', 'required', 'on' => self::SCENARIO_SET_SESSION_DATE],
            ['experts', 'required', 'on' => self::SCENARIO_SET_EXPERTS],
            [['title', 'englishTitle', 'code'], 'trim'],
            [['title', 'englishTitle'], 'string', 'max' => 255],
            ['code', 'string', 'max' => 4, 'min' => 4],
            [['reason', 'necessity', 'proceedings'], 'string'],
            [['tags', 'resources'], 'safe'],
            [
                ['sessionDate', 'createdAt'],
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

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_SET_EXPERTS] = ['experts'];
        return $scenarios;
    }

    public function attributeLabels()
    {
        return [
            'title' => 'عنوان',
            'englishTitle' => 'عنوان انگلیسی',
            'uniqueCode' => 'شناسه',
            'createdBy' => 'کارشناس',
            'createdAt' => 'تاریخ درج',
            'reason' => 'علت پیدایش',
            'necessity' => 'ضرورت های طرح موضوع',
            'code' => 'کد موضوع',
            'mainReasonId' => 'علت اصلی',
            'reasons' => 'علل فرعی',
            'resources' => 'منابع',
            'tags' => 'کلید واژه ها',
            'deliverToManagerDate' => 'تاریخ تحویل به مدیر',
            'sessionDate' => 'تاریخ جلسه توجیهی',
            'proceedings' => 'نتیجه برگزاری جلسه',
            'experts' => 'کارشناسان نگارش پروپوزال',
            'updatedAt' => 'آخرین بروزرسانی',
            'status' => 'وضعیت'
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

    public function canUserCreateProposal()
    {
        if (
            $this->status == self::STATUS_READY_FOR_NEXT_STEP ||
            $this->status == self::STATUS_IN_NEXT_STEP
        ) {
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

    public static function getStatusLables()
    {
        return array_replace(
            parent::getStatusLables(),
            [
                self::STATUS_READY_FOR_NEXT_STEP => 'آماده برای تهیه پروپوزال',
                self::STATUS_IN_NEXT_STEP => 'در حال تکمیل پروپوزال'
            ]
        );
    }
}
