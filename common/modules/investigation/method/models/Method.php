<?php

namespace nad\common\modules\investigation\method\models;

use extensions\file\behaviors\FileBehavior;
use extensions\tag\behaviors\TaggableBehavior;
use extensions\tag\behaviors\TaggableQueryBehavior;
use extensions\i18n\validators\JalaliDateToTimestamp;
use nad\extensions\comment\behaviors\CommentBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\common\modules\investigation\common\models\BaseInvestigationModel;

class Method extends BaseInvestigationModel
{
    public $moduleId = 'method';

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
                        'instruction' => [
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
                                    'pptx'
                                ],
                                'maxSize' => 100 * 1024 * 1024,
                                'required' => true
                            ]
                        ],
                        'document' => [
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
                    'abstract'
                ],
                'required'
            ],
            ['sessionDate', 'required', 'on' => self::SCENARIO_SET_SESSION_DATE],
            ['proceedings', 'required', 'on' => self::SCENARIO_WRITE_PROCEEDINGS],
            ['negotiationResult', 'required', 'on' => self::SCENARIO_WRITE_NEGOTIATION_RESULT],
            [['title', 'englishTitle'], 'string', 'max' => 255],
            [['abstract', 'description', 'proceedings', 'negotiationResult'], 'string'],
            ['englishTitle', 'default', 'value' => null],
            ['references', 'safe'],
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
                ['title', 'abstract', 'description', 'proceedings', 'negotiationResult'],
                FarsiCharactersValidator::class
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'عنوان',
            'englishTitle' => 'عنوان انگلیسی',
            'createdAt' => 'تاریخ درج',
            'abstract' => 'چکیده',
            'description' => 'توضیحات',
            'references' => 'منابع',
            'tags' => 'کلید واژه‌ها',
            'status' => 'وضعیت',
            'createdBy' => 'کارشناس',
            'updatedAt' => 'آخرین بروزرسانی',
            'deliverToManagerDate' => 'تاریخ تحویل به مدیر',
            'sessionDate' => 'تاریخ جلسه توجیهی',
            'proceedings' => 'نتیجه جلسه',
            'negotiationResult' => 'نتیجه مذاکره',
            'uniqueCode' => 'شناسه'
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

    public static function tableName()
    {
        return 'nad_investigation_method';
    }
}
