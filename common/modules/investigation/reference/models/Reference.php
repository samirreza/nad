<?php

namespace nad\common\modules\investigation\reference\models;

use nad\common\code\Codable;
use nad\common\code\CodableTrait;
use modules\user\common\models\User;
use yii\behaviors\BlameableBehavior;
use core\behaviors\TimestampBehavior;
use core\behaviors\PreventDeleteBehavior;
use extensions\file\behaviors\FileBehavior;
use extensions\tag\behaviors\TaggableBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\common\modules\investigation\common\behaviors\CodeNumeratorBehavior;

class Reference extends \yii\db\ActiveRecord implements Codable
{
    use CodableTrait;

    const TYPE_BOOK = 'B';
    const TYPE_PAPER = 'P';
    const TYPE_CATALOGUE = 'C';
    const TYPE_THESIS = 'T';
    const TYPE_REPORT = 'R';
    const TYPE_WEBSITE = 'W';

    public $moduleId = 'reference';

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
            'codeNumerator' => [
                'class' => CodeNumeratorBehavior::class,
                'determinativeColumn' => 'type'
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'createdBy',
                'updatedByAttribute' => false
            ],
            'tags' => [
                'class' => TaggableBehavior::class,
                'moduleId' => $this->moduleId
            ]
        ];
    }

    public function rules()
    {
        return [
            [['title', 'author', 'publisher', 'publishedYear'], 'trim'],
            [['title', 'type'], 'required'],
            ['publishedYear', 'integer'],
            [['title', 'author', 'publisher'], 'string', 'max' => 255],
            ['description', 'string'],
            ['tags', 'safe'],
            [['author', 'publisher', 'publishedYear', 'description'], 'default', 'value' => null],
            [
                'title',
                'unique',
                'targetAttribute' => ['title', 'type', 'consumer'],
                'message' => 'این عنوان قبلا در سیستم درج شده است.'
            ],
            [['title', 'description'], FarsiCharactersValidator::class]
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'عنوان',
            'type' => 'نوع',
            'author' => 'نویسنده',
            'publishedYear' => 'سال انتشار',
            'publisher' => 'انتشار دهنده',
            'tags' => 'کلید واژه‌ها',
            'description' => 'توضیحات',
            'uniqueCode' => 'شناسه',
            'createdAt' => 'تاریخ درج',
            'updatedAt' => 'آخرین بروزرسانی',
            'createdBy' => 'کارشناس'
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

    public function getUniqueCode() : string
    {
        return $this->uniqueCode;
    }

    public function getClientsQuery()
    {
        return (new \yii\db\Query())
            ->from('nad_investigation_reference_relation')
            ->where(['referenceId' => $this->id]);
    }

    public function getResearcher()
    {
        return $this->hasOne(User::class, ['id' => 'createdBy']);
    }

    public function getResearcherTitle()
    {
        if (!empty(trim($this->researcher->fullName))) {
            return $this->researcher->fullName;
        }
        return $this->researcher->email;
    }

    public function setUniqueCode()
    {
        $this->uniqueCode = static::CONSUMER_CODE . '.' . $this->type . '.' .
            $this->numberPartOfUniqueCode;
    }

    public static function tableName()
    {
        return 'nad_investigation_reference';
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
