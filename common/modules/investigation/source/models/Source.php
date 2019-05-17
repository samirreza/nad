<?php

namespace nad\common\modules\investigation\source\models;

use nad\office\modules\expert\models\Expert;
use extensions\tag\behaviors\TaggableBehavior;
use extensions\tag\behaviors\TaggableQueryBehavior;
use extensions\i18n\validators\JalaliDateToTimestamp;
use nad\extensions\comment\behaviors\CommentBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\common\modules\investigation\source\behaviors\ExpertsBehavior;
use nad\common\modules\investigation\source\behaviors\ReasonsBehavior;
use nad\common\modules\investigation\common\models\BaseInvestigationModel;
use nad\common\modules\investigation\common\behaviors\CodeNumeratorBehavior;

class Source extends BaseInvestigationModel
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'reasons' => ReasonsBehavior::class,
                'experts' => ExpertsBehavior::class,
                'tags' => [
                    'class' => TaggableBehavior::class,
                    'moduleId' => 'source'
                ],
                'comments' => [
                    'class' => CommentBehavior::class,
                    'moduleId' => $this->moduleId
                ],
                'codeNumerator' => [
                    'class' => CodeNumeratorBehavior::class,
                    'determinativeColumn' => 'mainReasonId'
                ],
                'taggableQuery' => [
                    'class' => TaggableQueryBehavior::class,
                    'modelShortClassName' => (new \ReflectionClass(self::class))
                        ->getShortName(),
                    'moduleId' => $this->moduleId
                ]
            ]
        );
    }

    public function rules()
    {
        return [
            [['title', 'englishTitle'], 'trim'],
            [
                [
                    'title',
                    'createdAt',
                    'reasonForGenesis',
                    'necessity',
                    'mainReasonId',
                    'reasons'
                ],
                'required'
            ],
            ['sessionDate', 'required', 'on' => self::SCENARIO_SET_SESSION_DATE],
            ['proceedings', 'required', 'on' => self::SCENARIO_WRITE_PROCEEDINGS],
            ['negotiationResult', 'required', 'on' => self::SCENARIO_WRITE_NEGOTIATION_RESULT],
            ['experts', 'required', 'on' => self::SCENARIO_SET_EXPERT],
            [['title', 'englishTitle'], 'string', 'max' => 255],
            [['reasonForGenesis', 'necessity', 'description', 'proceedings', 'negotiationResult'], 'string'],
            ['tags', 'safe'],
            ['englishTitle', 'default', 'value' => null],
            [
                'createdAt',
                JalaliDateToTimestamp::class,
                'when' => function ($model, $attribute) {
                    return $model->$attribute !== $model->getOldAttribute($attribute);
                }
            ],
            [
                'sessionDate',
                JalaliDateToTimestamp::class,
                'hourAttr' => 'sessionHourAttribute',
                'minuteAttr' => 'sessionMinuteAttribute',
                'when' => function ($model, $attribute) {
                    return $model->$attribute !== $model->getOldAttribute($attribute);
                }
            ],
            [
                ['title', 'reasonForGenesis', 'necessity', 'description', 'proceedings', 'negotiationResult'],
                FarsiCharactersValidator::class
            ]
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_SET_EXPERT] = ['experts'];
        return $scenarios;
    }

    public function attributeLabels()
    {
        return [
            'title' => 'عنوان',
            'englishTitle' => 'عنوان انگلیسی',
            'createdAt' => 'تاریخ درج',
            'reasonForGenesis' => 'علت پیدایش',
            'necessity' => 'ضرورت های طرح موضوع',
            'description' => 'توضیحات',
            'mainReasonId' => 'علت اصلی',
            'status' => 'وضعیت',
            'createdBy' => 'کارشناس',
            'updatedAt' => 'آخرین بروزرسانی',
            'deliverToManagerDate' => 'تاریخ تحویل به مدیر',
            'sessionDate' => 'تاریخ جلسه توجیهی',
            'proceedings' => 'نتیجه جلسه',
            'negotiationResult' => 'نتیجه مذاکره',
            'uniqueCode' => 'شناسه',
            'reasons' => 'علل فرعی',
            'tags' => 'کلید واژه‌ها',
            'experts' => 'کارشناسان نگارش پروپوزال'
        ];
    }

    public function getMainReason()
    {
        return $this->hasOne(SourceReason::class, ['id' => 'mainReasonId']);
    }

    public function getReasonsQuery()
    {
        return $this->hasMany(SourceReason::class, ['id' => 'reasonId'])
            ->viaTable('nad_investigation_source_reason_relation', ['sourceId' => 'id']);
    }

    public function getExpertsQuery()
    {
        return $this->hasMany(Expert::class, ['id' => 'expertId'])
            ->viaTable('nad_investigation_source_expert_relation', ['sourceId' => 'id']);
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
        $this->uniqueCode = static::CONSUMER_CODE . '.' . $this->mainReason->code .
            '.' . $this->numberPartOfUniqueCode;
    }

    public static function tableName()
    {
        return 'nad_investigation_source';
    }

    public static function getStatusLables()
    {
        $statusLabels = array_replace(
            parent::getStatusLables(),
            [
                self::STATUS_IN_NEXT_STEP => 'در حال تکمیل پروپوزال'
            ]
        );
        return $statusLabels;
    }
}
