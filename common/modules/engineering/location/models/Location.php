<?php
namespace nad\common\modules\engineering\location\models;

use nad\common\code\Codable;
use nad\common\code\CodableTrait;
use extensions\file\behaviors\FileBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\common\modules\engineering\stage\models\Category;

class Location extends \yii\db\ActiveRecord implements Codable
{
    use CodableTrait;

    public static function tableName()
    {
        return 'nad_eng_location';
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'core\behaviors\TimestampBehavior',
                [
                    'class' => FileBehavior::className(),
                    'groups' => [
                        'file' => [
                            'type' => FileBehavior::TYPE_FILE,
                            'rules' => [
                                'extensions' => ['png', 'jpg', 'jpeg', 'pdf', 'docx', 'doc', 'xlsx'],
                                'maxSize' => 5*1024*1024,
                            ]
                        ],
                    ]
                ]
            ]
        );
    }

    public function rules()
    {
        return [
            [['title', 'categoryId', 'code'], 'required'],
            [['title', 'code'], 'trim'],
            [['title'], 'string', 'max' => 255],
            ['code', 'string', 'max' => 10, 'min' => 1],
            [['categoryId'], 'integer'],
            [['description'], 'string'],
            [['title'], FarsiCharactersValidator::className()],
            [
                'code',
                'unique',
                'targetAttribute' => ['code', 'categoryId'],
                'message' => 'این شناسه پیش تر ثبت شده است.'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'code' => 'شناسه گروه',
            'uniqueCode' => 'شناسه گروه',
            'title' => 'عنوان گروه',
            'description' => 'توضیحات',
            'categoryId' => 'عنوان رده - شناسه رده',
            'category.title' => 'عنوان رده',
            'category.familyTreeTitle' => 'عنوان رده (شاخه)',
            'createdAt' => 'تاریخ درج',
            'updatedAt' => 'آخرین بروزرسانی'
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'categoryId']);
    }

    // public function getStageCategories()
    // {
    //     return $this->hasMany(StageCategory::className(), ['id' => 'stageCategoryId'])->viaTable('nad_eng_location_stage', ['locationId' => 'id']);
    // }

    public function beforeValidate()
    {
        $this->code = strtoupper($this->code);
        return parent::beforeValidate();
    }

    public function beforeSave($insert)
    {
        if ($insert) {            
            $this->consumer = static::CONSUMER_CODE;
        }
        $this->setUniqueCode();
        return parent::beforeSave($insert);
    }

    public function setUniqueCode()
    {
        $this->uniqueCode = $this->category->uniqueCode . '.' . $this->code;
    }
    
    public function getUniqueCode() : string
    {
        $category = $this->category;
        if(!isset($category)){
            $category = Category::findOne($this->categoryId);
        }
        
        return $category->code . '.' . $this->code;
    }
}
