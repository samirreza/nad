<?php

namespace nad\research\investigation\project\models;

use core\tree\NestedSetsBehavior;
use extensions\file\behaviors\FileBehavior;
use extensions\tag\behaviors\TaggableBehavior;
use creocoder\nestedsets\NestedSetsQueryBehavior;
use extensions\i18n\validators\JalaliDateToTimestamp;
use nad\extensions\comment\behaviors\CommentBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\research\common\behaviors\CodeNumeratorBehavior;
use nad\research\investigation\proposal\models\Proposal;
use nad\research\investigation\common\models\BaseInvestigationModel;

class Project extends BaseInvestigationModel
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'Tags' => [
                    'class' => TaggableBehavior::class,
                    'moduleId' => 'project'
                ],
                'Comments' => [
                    'class' => CommentBehavior::class,
                    'moduleId' => 'project'
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
                [
                    'class' => CodeNumeratorBehavior::class,
                    'determinativeColumn' => 'categoryId'
                ],
                'tree' => [
                    'class' => NestedSetsBehavior::class,
                    'treeAttribute' => 'tree'
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
                    'createdAt',
                    'abstract',
                    'categoryId',
                    'parentId'
                ],
                'required'
            ],
            ['sessionDate', 'required', 'on' => self::SCENARIO_SET_SESSION_DATE],
            [['title', 'englishTitle'], 'trim'],
            [['title', 'englishTitle'], 'string', 'max' => 255],
            [['abstract', 'proceedings'], 'string'],
            [['tags', 'resources'], 'safe'],
            [
                ['title', 'abstract', 'proceedings'],
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
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'عنوان',
            'englishTitle' => 'عنوان انگلیسی',
            'uniqueCode' => 'شناسه',
            'createdBy' => 'کارشناس',
            'createdAt' => 'تاریخ درج',
            'abstract' => 'چکیده',
            'proposalId' => 'پروپوزال',
            'categoryId' => 'رده',
            'parentId' => 'گزارش پدر',
            'resources' => 'منابع',
            'tags' => 'کلید واژه‌ها',
            'deliverToManagerDate' => 'تاریخ تحویل به مدیر',
            'sessionDate' => 'تاریخ جلسه توجیهی',
            'proceedings' => 'نتیجه برگزاری جلسه',
            'updatedAt' => 'آخرین بروزرسانی',
            'status' => 'وضعیت'
        ];
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
        $this->uniqueCode = $this->category->uniqueCode . '.' .
            $this->lastPartOfUniqueCode;
    }

    public function getProposal()
    {
        return $this->hasOne(Proposal::class, ['id' => 'proposalId']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'categoryId']);
    }

    public function getPrefixedTitle()
    {
        $prefix = '';
        for ($i = 0; $i < $this->depth; $i++) {
            $prefix .= '- ';
        }
        return $prefix . ' ' . $this->codedTitle;
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $this->proposal->changeStatus(Proposal::STATUS_IN_NEXT_STEP);
        } elseif ($this->status == self::STATUS_FINISHED) {
            $this->proposal->changeStatus(Proposal::STATUS_FINISHED);
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public static function tableName()
    {
        return 'nad_research_project';
    }

    public static function find()
    {
        $query = parent::find();
        $query->attachBehavior(
            'nestedQuery',
            NestedSetsQueryBehavior::class
        );
        return $query->orderBy([
            'nad_research_project.tree' => SORT_DESC,
            'nad_research_project.lft' => SORT_ASC
        ]);
    }

    public static function getStatusLables()
    {
        $statusLabels = array_replace(
            parent::getStatusLables(),
            [
                self::STATUS_FINISHED => 'آرشیو شده'
            ]
        );
        unset(
            $statusLabels[self::STATUS_REJECTED],
            $statusLabels[self::STATUS_READY_FOR_NEXT_STEP],
            $statusLabels[self::STATUS_IN_NEXT_STEP]
        );
        return $statusLabels;
    }
}
