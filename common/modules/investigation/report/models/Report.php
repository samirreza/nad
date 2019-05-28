<?php

namespace nad\common\modules\investigation\report\models;

use extensions\file\behaviors\FileBehavior;
use extensions\tag\behaviors\TaggableBehavior;
use extensions\tag\behaviors\TaggableQueryBehavior;
use extensions\i18n\validators\JalaliDateToTimestamp;
use nad\extensions\comment\behaviors\CommentBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\extensions\graphGenerator\behaviors\GraphBehavior;
use nad\common\modules\investigation\proposal\models\Proposal;
use nad\common\modules\investigation\common\models\BaseInvestigationModel;
use nad\common\modules\investigation\common\behaviors\CodeNumeratorBehavior;

class Report extends BaseInvestigationModel
{
    public $moduleId = 'report';

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
                        'report' => [
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
                        'doc' => [
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
                'codeNumerator' => [
                    'class' => CodeNumeratorBehavior::class,
                    'determinativeColumn' => 'categoryId'
                ],
                'graph' => [
                    'class' => GraphBehavior::className(),
                    'graphTableName' => 'nad_report_graph'
                ],
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
                    'abstract',
                    'categoryId'
                ],
                'required'
            ],
            ['sessionDate', 'required', 'on' => self::SCENARIO_SET_SESSION_DATE],
            ['proceedings', 'required', 'on' => self::SCENARIO_WRITE_PROCEEDINGS],
            ['negotiationResult', 'required', 'on' => self::SCENARIO_WRITE_NEGOTIATION_RESULT],

            [['title', 'englishTitle'], 'string', 'max' => 255],
            [['abstract', 'description', 'proceedings', 'negotiationResult'], 'string'],
            ['englishTitle', 'default', 'value' => null],
            [['tags', 'references'], 'safe'],
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
            'proposalId' => 'پروپوزال'
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
    }

    public function getProposal()
    {
        return $this->hasOne(Proposal::class, ['id' => 'proposalId']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'categoryId']);
    }

    public static function tableName()
    {
        return 'nad_investigation_report';
    }

    public static function getStatusLables()
    {
        $statusLabels = array_replace(
            parent::getStatusLables(),
            [
                self::STATUS_IN_NEXT_STEP => 'آرشیو شده'
            ]
        );
        return $statusLabels;
    }
}
