<?php
namespace nad\common\modules\engineering\stage\models;

use yii\helpers\ArrayHelper;
use nad\common\code\Codable;
use nad\common\code\CodableTrait;
use extensions\file\behaviors\FileBehavior;
use nad\common\modules\engineering\location\models\Location;
use extensions\i18n\validators\FarsiCharactersValidator;

class Stage extends \yii\db\ActiveRecord implements Codable
{
    use CodableTrait;

    public static function tableName()
    {
        return 'nad_eng_stage';
    }

    public function getUniqueCode() : string
    {
        return $this->uniqueCode;
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
            ['code', 'string', 'max' => 1, 'min' => 1],
            [['categoryId', 'parentId'], 'integer'],            
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
            'code' => 'شناسه مرحله',
            'uniqueCode' => 'شناسه مرحله',
            'title' => 'عنوان',
            'description' => 'توضیحات',
            'categoryId' => 'زیر شاخه',
            'parentId' => 'مرحله پدر',
            'locations' => 'مکان ها',
            'category.title' => 'زیر شاخه',
            'category.familyTreeTitle' => 'زیر شاخه',
            'createdAt' => 'تاریخ درج',
            'updatedAt' => 'آخرین بروزرسانی'
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'categoryId']);
    }

    public function getParent()
    {
        return $this->hasOne(self::className(), ['id' => 'parentId']);
    }

    public function getLocations()
    {
        return $this->hasMany(Location::className(), ['id' => 'locationId'])->viaTable('nad_eng_location_stage', ['stageId' => 'id']);
    }

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

    public function getAllStagesAsDropdown(){
        return ArrayHelper::map(
            static::find()->select(['id', 'title'])->where('id != :id OR :id IS NULL', ['id' => $this->id])->all(),
            'id',
            'title'
        );
    }

    public function getAllLocationsAsDropdown(){
        return ArrayHelper::map(
            Location::find()->select(['id', 'title'])->where('consumer = :consumer_code', ['consumer_code' => static::CONSUMER_CODE])->all(),
            'id',
            'title'
        );
    }
}
