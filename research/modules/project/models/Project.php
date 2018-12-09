<?php

namespace nad\research\modules\project\models;

use yii\behaviors\BlameableBehavior;
use core\behaviors\TimestampBehavior;
use modules\user\backend\models\User;
use extensions\file\behaviors\FileBehavior;
use nad\research\common\models\BaseReasearch;
use extensions\tag\behaviors\TaggableBehavior;
use nad\research\modules\proposal\models\Proposal;
use extensions\i18n\validators\JalaliDateToTimestamp;
use nad\extensions\comment\behaviors\CommentBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\extensions\documentation\behaviors\DocumentationBehavior;

class Project extends BaseReasearch
{
    const STATUS_ARCHIVED = 7;

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            'Documentation' => DocumentationBehavior::class,
            'Tags' => [
                'class' => TaggableBehavior::class,
                'moduleId' => 'project'
            ],
            'Comments' => [
                'class' => CommentBehavior::class,
                'moduleId' => 'project'
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'createdBy',
                'updatedByAttribute' => false
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
            ]
        ];
    }

    public function rules()
    {
        return [
            [
                [
                    'title',
                    'abstract'
                ],
                'required'
            ],
            [
                'sessionDate',
                JalaliDateToTimestamp::class,
                'when' => function ($model, $attribute) {
                    return $model->$attribute !== $model->getOldAttribute($attribute);
                }
            ],
            ['title', 'string', 'max' => 255],
            [['abstract', 'proceedings'], 'string'],
            [
                ['abstract', 'proceedings'],
                FarsiCharactersValidator::class
            ],
            ['tags', 'safe'],
            [
                'proposalId',
                'exist',
                'targetClass' => Proposal::class,
                'targetAttribute' => ['proposalId' => 'id']
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'title' => 'عنوان',
            'createdBy' => 'محقق',
            'createdAt' => 'تاریخ اتمام گزارش',
            'abstract' => 'چکیده',
            'deliverToManagerDate' => 'تاریخ تحویل به مدیر',
            'sessionDate' => 'تاریخ جلسه توجیهی',
            'proceedings' => 'نتیجه برگزاری جلسه',
            'status' => 'وضعیت',
            'updatedAt' => 'آخرین بروزرسانی',
            'tags' => 'کلید واژه ها',
            'proposalId' => 'پروپوژال'
        ];
    }

    public function getResearcher()
    {
        return $this->hasOne(User::class, ['id' => 'createdBy']);
    }

    public function getProposal()
    {
        return $this->hasOne(Proposal::class, ['id' => 'proposalId']);
    }

    public static function tableName()
    {
        return 'nad_research_project';
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
