<?php

namespace nad\research\extensions\resource\models;

use yii\db\ActiveRecord;
use nad\common\code\Codable;
use nad\common\code\CodableTrait;
use core\behaviors\TimestampBehavior;
use core\behaviors\PreventDeleteBehavior;
use extensions\file\behaviors\FileBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\research\common\behaviors\CodeNumeratorBehavior;

class Resource extends ActiveRecord implements Codable
{
    use CodableTrait;

    const TYPE_BOOK = 'B';
    const TYPE_PAPER = 'P';
    const TYPE_CATALOGUE = 'C';
    const TYPE_THESIS = 'T';
    const TYPE_REPORT = 'R';
    const TYPE_WEBSITE = 'w';

    const CLIENT_INVESTIGATION = 0;

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => PreventDeleteBehavior::class,
                'relations' => [
                    [
                        'relationMethod' => 'getClientsQuery',
                        'relationName' => 'آیتم'
                    ]
                ]
            ],
            [
                'class' => FileBehavior::class,
                'groups' => [
                    'resource' => [
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
                    ]
                ]
            ],
            [
                'class' => CodeNumeratorBehavior::class,
                'determinativeColumn' => 'type'
            ]
        ];
    }

    public function rules()
    {
        return [
            [['title', 'type'], 'required'],
            [['title', 'author', 'publisher', 'publishYear'], 'trim'],
            [['title', 'author', 'publisher'], 'string', 'max' => 255],
            ['publishYear', 'integer'],
            ['description', 'string'],
            ['description', 'default', 'value' => null],
            [
                'title',
                'unique',
                'targetAttribute' => ['title', 'type', 'clientId'],
                'message' => 'این عنوان قبلا در سیستم درج شده است.'
            ],
            [['title', 'description'], FarsiCharactersValidator::class]
        ];
    }

    public function attributeLabels()
    {
        return [
            'uniqueCode' => 'شناسه',
            'title' => 'عنوان',
            'type' => 'نوع',
            'publishYear' => 'سال انتشار',
            'author' => 'نویسنده',
            'publisher' => 'انتشار دهنده',
            'description' => 'توضیحات',
            'createdAt' => 'تاریخ درج'
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
        $this->uniqueCode = $this->type . '.' . $this->lastPartOfUniqueCode;
    }

    public function getUniqueCode() : string
    {
        return $this->uniqueCode;
    }

    public function getLastInsertedCode()
    {
        return self::find()
            ->andWhere([
                'type' => $this->type,
                'clientId' => $this->clientId
            ])
            ->max('lastCode');
    }

    public function getClientsQuery()
    {
        return (new \yii\db\Query())
            ->from('nad_research_resource_relation')
            ->where(['resourceId' => $this->id]);
    }

    public static function tableName()
    {
        return 'nad_research_resource';
    }

    public static function getTypeLabels()
    {
        return [
            self::TYPE_BOOK => 'کتاب',
            self::TYPE_PAPER => 'مقاله',
            self::TYPE_CATALOGUE => 'بروشور',
            self::TYPE_THESIS => 'پایان نامه',
            self::TYPE_REPORT => 'گزارش',
            self::TYPE_WEBSITE => 'وب سایت'
        ];
    }
}
