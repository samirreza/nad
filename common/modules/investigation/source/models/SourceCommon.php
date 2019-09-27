<?php

namespace nad\common\modules\investigation\source\models;

use Yii;
use core\behaviors\PreventDeleteBehavior;
use nad\office\modules\expert\models\Expert;
use nad\common\modules\investigation\common\behaviors\TaggableBehavior;
use extensions\i18n\validators\JalaliDateToTimestamp;
use nad\common\modules\investigation\common\behaviors\CommentBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\common\modules\investigation\proposal\models\Proposal;
use nad\common\modules\investigation\source\behaviors\ExpertsBehavior;
// use nad\common\modules\investigation\source\behaviors\ReasonsBehavior;
use nad\common\modules\investigation\common\models\BaseInvestigationModel;
use nad\common\modules\investigation\source\behaviors\NotificationBehavior;
use nad\common\modules\investigation\common\behaviors\CodeNumeratorBehavior;

class SourceCommon extends BaseInvestigationModel
{
    // TODO Remove all "reasons" related things asap.

    public $moduleId = 'source';
    public $ownerClassName = __NAMESPACE__ . '\Source';

    const EVENT_SET_EXPERTS = 'set-experts';

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                // 'reasons' => ReasonsBehavior::class,
                'experts' => ExpertsBehavior::class,
                'tags' => [
                    'class' => TaggableBehavior::class,
                    'moduleId' => $this->moduleId,
                    'customOwner' => $this->ownerClassName
                ],
                'comments' => [
                    'class' => CommentBehavior::class,
                    'moduleId' => $this->moduleId,
                    'customOwner' => $this->ownerClassName
                ],
                'codeNumerator' => [
                    'class' => CodeNumeratorBehavior::class,
                    'determinativeColumn' => 'categoryId'
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
                'notification' => NotificationBehavior::class
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
                    'categoryId'
                    // 'reasons'
                ],
                'required'
            ],
            ['sessionDate', 'required', 'on' => self::SCENARIO_SET_SESSION_DATE],
            ['proceedings', 'required', 'on' => self::SCENARIO_WRITE_PROCEEDINGS],
            ['negotiationResult', 'required', 'on' => self::SCENARIO_WRITE_NEGOTIATION_RESULT],
            ['experts', 'required', 'on' => self::SCENARIO_SET_EXPERT],
            [['title', 'englishTitle'], 'string', 'max' => 255],
            [['reasonForGenesis', 'necessity', 'description', 'proceedings', 'negotiationResult'], 'string'],
            [['tags', 'references'], 'safe'],
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
            'reasonForGenesis' => 'سابقه پیدایش',
            'necessity' => 'شرح عنوان',
            'description' => 'توضیحات',
            'mainReasonId' => 'علت طرح موضوع',
            // 'reasons' => 'علل فرعی',
            'categoryId' => 'رده',
            'references' => 'منابع',
            'tags' => 'کلید واژه‌ها',
            'status' => 'وضعیت',
            'createdBy' => 'کارشناس',
            'updatedAt' => 'آخرین بروزرسانی',
            'deliverToManagerDate' => 'تاریخ تحویل به مدیر',
            'sessionDate' => 'تاریخ جلسه توجیهی',
            'proceedings' => 'نتیجه جلسه',
            'negotiationResult' => 'نتیجه مذاکره',
            'uniqueCode' => 'شناسه',
            'experts' => 'کارشناسان نگارش پروپوزال'
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if ($insert) {
            $this->consumer = static::CONSUMER_CODE;
        }
        $this->setUniqueCode();
        return true;
    }

    public function setUniqueCode()
    {
        $this->uniqueCode = $this->category->uniqueCode . '.' .
            $this->numberPartOfUniqueCode;
        // $this->uniqueCode = static::CONSUMER_CODE . '.' . $this->mainReason->code .
            // '.' . $this->numberPartOfUniqueCode;
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (
            isset($changedAttributes['status']) &&
            $changedAttributes['status'] == self::STATUS_ACCEPTED &&
            $this->status == self::STATUS_IN_NEXT_STEP
        ) {
            $this->trigger(self::EVENT_SET_EXPERTS);
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function getMainReason()
    {
        return $this->hasOne(SourceReason::class, ['id' => 'mainReasonId']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'categoryId']);
    }
    // public function getReasonsQuery()
    // {
    //     return $this->hasMany(SourceReason::class, ['id' => 'reasonId'])
    //         ->viaTable('nad_investigation_source_reason_relation', ['sourceId' => 'id']);
    // }

    public function getExpertsQuery()
    {
        return $this->hasMany(Expert::class, ['id' => 'expertId'])
            ->viaTable('nad_investigation_source_expert_relation', ['sourceId' => 'id']);
    }

    public function getProposals()
    {
        return $this->hasMany(Proposal::class, ['sourceId' => 'id']);
    }

    public function canUserCreateProposal()
    {
        if ($this->status == self::STATUS_IN_NEXT_STEP) {
            if (Yii::$app->user->can('superuser')) {
                return true;
            }
            return $this->hasExperts(Expert::findOne([
                'userId' => Yii::$app->user->id
            ])->id);
        }
        return false;
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

    public function changeArchive($newStatus)
    {
        $this->isArchived = $newStatus;
        $this->save(false);
    }
}
