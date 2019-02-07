<?php

namespace nad\research\investigation\proposal\models;

use Yii;
use core\behaviors\PreventDeleteBehavior;
use extensions\file\behaviors\FileBehavior;
use nad\office\modules\expert\models\Expert;
use extensions\tag\behaviors\TaggableBehavior;
use extensions\tag\behaviors\TaggableQueryBehavior;
use nad\research\investigation\source\models\Source;
use extensions\i18n\validators\JalaliDateToTimestamp;
use nad\extensions\comment\behaviors\CommentBehavior;
use nad\research\investigation\project\models\Project;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\research\investigation\proposal\behaviors\PartnersBehavior;
use nad\research\investigation\common\models\BaseInvestigationModel;

class Proposal extends BaseInvestigationModel
{
    const SCENARIO_SET_EXPERT = 'setExpert';

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                [
                    'class' => PreventDeleteBehavior::class,
                    'relations' => [
                        [
                            'relationMethod' => 'getProject',
                            'relationName' => 'پروژه'
                        ]
                    ]
                ],
                'Tags' => [
                    'class' => TaggableBehavior::class,
                    'moduleId' => 'proposal'
                ],
                'Comments' => [
                    'class' => CommentBehavior::class,
                    'moduleId' => 'proposal'
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
                PartnersBehavior::class
            ]
        );
    }

    public function rules()
    {
        return [
            [
                [
                    'title',
                    'createdAt',
                    'necessity',
                    'mainPurpose',
                    'secondaryPurpose',
                    'code'
                ],
                'required'
            ],
            ['sessionDate', 'required', 'on' => self::SCENARIO_SET_SESSION_DATE],
            ['projectExpertId', 'required', 'on' => self::SCENARIO_SET_EXPERT],
            [['title', 'englishTitle', 'code'], 'trim'],
            [['title', 'englishTitle'], 'string', 'max' => 255],
            ['code', 'string', 'max' => 4, 'min' => 4],
            [
                ['necessity', 'mainPurpose', 'secondaryPurpose', 'proceedings'],
                'string'
            ],
            ['code', 'unique'],
            ['englishTitle', 'default', 'value' => null],
            [['tags', 'resources', 'partners'], 'safe'],
            [
                ['title', 'necessity', 'mainPurpose', 'secondaryPurpose', 'proceedings'],
                FarsiCharactersValidator::class
            ],
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
            ['tags', 'validateTagsCount', 'skipOnEmpty' => false]
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

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_SET_EXPERT] = ['projectExpertId'];
        return $scenarios;
    }

    public function attributeLabels()
    {
        return [
            'title' => 'عنوان',
            'englishTitle' => 'عنوان انگلیسی',
            'uniqueCode' => 'شناسه',
            'lastCode' => 'نسخه',
            'createdBy' => 'کارشناس',
            'createdAt' => 'تاریخ درج',
            'necessity' => 'ضرورت اجرای طرح',
            'mainPurpose' => 'هدف اصلی',
            'secondaryPurpose' => 'اهداف فرعی',
            'code' => 'کد موضوع',
            'resources' => 'منابع',
            'partners' => 'همکاران',
            'tags' => 'کلید واژه ها',
            'sourceId' => 'منشا',
            'deliverToManagerDate' => 'تاریخ تحویل به مدیر',
            'sessionDate' => 'تاریخ جلسه توجیهی',
            'negotiateDate' => 'تاریخ مذاکره',
            'proceedings' => 'نتیجه برگزاری جلسه',
            'projectExpertId' => 'کارشناس نگارش گزارش',
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
            str_pad(self::find()->count() + 1, 3, '0', STR_PAD_LEFT);
    }

    public function getPartners()
    {
        return $this->hasMany(Expert::class, ['id' => 'expertId'])
            ->viaTable('nad_research_proposal_partner_relation', ['proposalId' => 'id']);
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
        if ($this->status == self::STATUS_READY_FOR_NEXT_STEP) {
            if (Yii::$app->user->can('research.manage')) {
                return true;
            }
            return $this->projectExpertId == Expert::findOne([
                'userId' => Yii::$app->user->id
            ])->id;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $this->source->changeStatus(Source::STATUS_IN_NEXT_STEP);
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
        $statusLabels = array_replace(
            parent::getStatusLables(),
            [
                self::STATUS_READY_FOR_NEXT_STEP => 'آماده برای نگارش گزارش',
                self::STATUS_IN_NEXT_STEP => 'در حال تکمیل گزارش'
            ]
        );
        unset($statusLabels[self::STATUS_REJECTED]);
        return $statusLabels;
    }
}
