<?php

namespace nad\research\modules\proposal\models;

use Yii;
use extensions\file\behaviors\FileBehavior;
use nad\research\common\models\BaseResearch;
use extensions\tag\behaviors\TaggableBehavior;
use nad\research\modules\source\models\Source;
use nad\research\modules\project\models\Project;
use extensions\tag\behaviors\TaggableQueryBehavior;
use extensions\i18n\validators\JalaliDateToTimestamp;
use nad\extensions\comment\behaviors\CommentBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\research\modules\proposal\behaviors\PartnersBehavior;

class Proposal extends BaseResearch
{
    const SCENARIO_SET_EXPERT = 'setExpert';

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
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
                                'maxSize' => 10 * 1024 * 1024
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
                    'code',
                    'createdAt',
                    'necessity',
                    'mainPurpose',
                    'secondaryPurpose'
                ],
                'required'
            ],
            ['sessionDate', 'required', 'on' => self::SCENARIO_SET_SESSION_DATE],
            ['expertUserId', 'required', 'on' => self::SCENARIO_SET_EXPERT],
            [['title', 'englishTitle', 'code'], 'trim'],
            [['title', 'englishTitle'], 'string', 'max' => 255],
            ['code', 'string', 'max' => 4, 'min' => 4],
            [
                ['necessity', 'mainPurpose', 'secondaryPurpose', 'proceedings'],
                'string'
            ],
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
        $scenarios[self::SCENARIO_SET_EXPERT] = ['expertUserId'];
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
            return $this->expertUserId == Yii::$app->user->id;
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
