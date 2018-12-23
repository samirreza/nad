<?php

namespace nad\research\modules\project\models;

use core\tree\NestedSetsBehavior;
use extensions\file\behaviors\FileBehavior;
use nad\research\common\models\BaseResearch;
use extensions\tag\behaviors\TaggableBehavior;
use nad\research\common\behaviors\CodeNumerator;
use nad\research\modules\proposal\models\Proposal;
use extensions\i18n\validators\JalaliDateToTimestamp;
use nad\extensions\comment\behaviors\CommentBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;

class Project extends BaseResearch
{
    const STATUS_ARCHIVED = 7;

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
                                'maxSize' => 5 * 1024 * 1024,
                                'required' => true
                            ]
                        ]
                    ]
                ],
                [
                    'class' => CodeNumerator::class,
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
                    'abstract',
                    'categoryId',
                    'parentId'
                ],
                'required'
            ],
            ['sessionDate', 'required', 'on' => self::SCENARIO_SET_SESSION_DATE],
            ['title', 'trim'],
            ['title', 'string', 'max' => 255],
            [['abstract', 'proceedings'], 'string'],
            [['tags', 'resources'], 'safe'],
            [
                ['abstract', 'proceedings'],
                FarsiCharactersValidator::class
            ],
            [
                'sessionDate',
                JalaliDateToTimestamp::class,
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
            'uniqueCode' => 'شناسه',
            'createdBy' => 'محقق',
            'createdAt' => 'تاریخ اتمام گزارش',
            'abstract' => 'چکیده',
            'proposalId' => 'پروپوزال',
            'categoryId' => 'رده',
            'parentId' => 'گزارش پدر',
            'resources' => 'منابع',
            'tags' => 'کلید واژه ها',
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
            $this->lastCodePart;
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

    public function canUserUpdateOrDelete()
    {
        if ($this->status == self::STATUS_ARCHIVED) {
            return false;
        }
        return parent::canUserUpdateOrDelete();
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $this->proposal->changeStatus(Proposal::STATUS_PROJECT_CREATED);
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
            'creocoder\nestedsets\NestedSetsQueryBehavior'
        );
        return $query->orderBy([
            'nad_research_project.tree' => SORT_DESC,
            'nad_research_project.lft' => SORT_ASC
        ]);
    }

    public static function getStatusLables()
    {
        $statusLabels = array_merge(
            parent::getStatusLables(),
            [
                self::STATUS_ARCHIVED => 'آرشیو شده'
            ]
        );
        unset($statusLabels[self::STATUS_REJECTED]);
        return $statusLabels;
    }
}
