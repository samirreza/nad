<?php

namespace nad\common\modules\investigation\proposal\models;

use Yii;
use core\behaviors\PreventDeleteBehavior;
use extensions\file\behaviors\FileBehavior;
use nad\office\modules\expert\models\Expert;
use extensions\tag\behaviors\TaggableBehavior;
use extensions\tag\behaviors\TaggableQueryBehavior;
use extensions\i18n\validators\JalaliDateToTimestamp;
use nad\extensions\comment\behaviors\CommentBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\common\modules\investigation\report\models\Report;
use nad\common\modules\investigation\source\models\Source;
use nad\common\modules\investigation\proposal\behaviors\PartnersBehavior;
use nad\common\modules\investigation\common\models\BaseInvestigationModel;

class Proposal extends BaseInvestigationModel
{
    public $moduleId = 'proposal';

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'tags' => [
                    'class' => TaggableBehavior::class,
                    'moduleId' => $this->moduleId
                ],
                'comments' => [
                    'class' => CommentBehavior::class,
                    'moduleId' => $this->moduleId
                ],
                'taggableQuery' => [
                    'class' => TaggableQueryBehavior::class,
                    'modelShortClassName' => (new \ReflectionClass(self::class))
                        ->getShortName(),
                    'moduleId' => $this->moduleId
                ],
                [
                    'class' => FileBehavior::class,
                    'groups' => [
                        'documents' => [
                            'type' => FileBehavior::TYPE_FILE,
                            'rules' => [
                                'extensions' => [
                                    'png',
                                    'jpg',
                                    'jpeg',
                                    'pdf',
                                    'doc',
                                    'docx',
                                    'xls',
                                    'xlsx',
                                    'ppt',
                                    'pptx',
                                    'zip'
                                ],
                                'maxSize' => 100 * 1024 * 1024
                            ]
                        ]
                    ]
                ],
                'partners' => PartnersBehavior::class,
                [
                    'class' => PreventDeleteBehavior::class,
                    'relations' => [
                        [
                            'relationMethod' => 'getReport',
                            'relationName' => 'گزارش'
                        ]
                    ]
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
                    'necessity'
                ],
                'required'
            ],
            ['sessionDate', 'required', 'on' => self::SCENARIO_SET_SESSION_DATE],
            ['proceedings', 'required', 'on' => self::SCENARIO_WRITE_PROCEEDINGS],
            ['negotiationResult', 'required', 'on' => self::SCENARIO_WRITE_NEGOTIATION_RESULT],
            ['reportExpertId', 'required', 'on' => self::SCENARIO_SET_EXPERT],
            [['title', 'englishTitle'], 'string', 'max' => 255],
            [['reasonForGenesis', 'necessity', 'description', 'proceedings', 'negotiationResult'], 'string'],
            ['englishTitle', 'default', 'value' => null],
            [['partners', 'references'], 'safe'],
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
            ],
            ['tags', 'validateTagsCount', 'skipOnEmpty' => false]
        ];
    }

    public function validateTagsCount($model, $attribute)
    {
        if (count($this->tags) < 3) {
            $this->addError(
                'tags',
                'تعداد کلید واژه‌ها باید حداقل ۳ عدد باشد.'
            );
        }
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_SET_EXPERT] = ['reportExpertId'];
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
            'partners' => 'همکاران',
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
            'sourceId' => 'منشا',
            'reportExpertId' => 'کارشناس نگارش گزارش'
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if ($insert) {
            $this->lastCodeNumber = 1;
            $this->consumer = static::CONSUMER_CODE;
        } elseif (
            $this->oldAttributes['status'] == self::STATUS_NEED_CORRECTION &&
            $this->status == self::STATUS_IN_MANAGER_HAND
        ) {
            $this->lastCodeNumber = $this->lastCodeNumber + 1;
        }
        $this->setUniqueCode();
        return true;
    }

    public function setUniqueCode()
    {
        $this->uniqueCode = static::CONSUMER_CODE . '.' .
            str_pad(static::find()->count() + 1, 3, '0', STR_PAD_LEFT) . '.' .
            $this->lastCodeNumber;
    }

    public function getPartnersQuery()
    {
        return $this->hasMany(Expert::class, ['id' => 'expertId'])
            ->viaTable('nad_investigation_proposal_partner_relation', ['proposalId' => 'id']);
    }

    public function getSource()
    {
        return $this->hasOne(Source::class, ['id' => 'sourceId']);
    }

    public function getReport()
    {
        return $this->hasOne(Report::class, ['proposalId' => 'id']);
    }

    public function canUserCreateReport()
    {
        if ($this->status == self::STATUS_IN_NEXT_STEP) {
            if (Yii::$app->user->can('superuser')) {
                return true;
            }
            return $this->reportExpertId == Expert::findOne([
                'userId' => Yii::$app->user->id
            ])->id;
        }
        return false;
    }

    public static function tableName()
    {
        return 'nad_investigation_proposal';
    }

    public static function getStatusLables()
    {
        $statusLabels = array_replace(
            parent::getStatusLables(),
            [
                self::STATUS_IN_NEXT_STEP => 'در حال تکمیل گزارش'
            ]
        );
        return $statusLabels;
    }
}
