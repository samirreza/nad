<?php
namespace nad\common\modules\engineering\document\models;

use nad\common\code\Codable;
use nad\common\code\CodableTrait;
use extensions\file\behaviors\FileBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\common\modules\engineering\location\models\Location;

class Document extends \yii\db\ActiveRecord implements Codable
{
    use CodableTrait;

    const LOOKUP_DOCUMENT_TYPE = 'nad.stage.document.Type';    

    public static function tableName()
    {
        return 'nad_eng_stage_document';
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
                        'fileRevised' => [
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
            [['title', 'groupId', 'documentType'], 'required'],
            [['title'], 'trim'],
            [['title', 'producerName', 'verifierName'], 'string', 'max' => 255],        
            [['groupId', 'documentType', 'revisionNumber'], 'integer'],
            [['description'], 'string'],
            [['title', 'producerName', 'verifierName', 'description'], FarsiCharactersValidator::className()],
        ];
    }

    public function attributeLabels()
    {
        return [            
            'uniqueCode' => 'شناسه مدرک',
            'title' => 'عنوان مدرک',
            'producerName' => 'نام تهیه کننده',
            'verifierName' => 'نام تایید کننده',
            'documentType' => 'نوع مدرک',
            'revisionNumber' => 'شماره بازنگری',
            'description' => 'توضیحات',
            'groupId' => 'شناسه گروه مدارک',
            'location.title' => 'عنوان گروه مدارک',
            'category.familyTreeTitle' => 'عنوان رده (شاخه)',
            'createdAt' => 'تاریخ درج',
            'updatedAt' => 'آخرین بروزرسانی'
        ];
    }

    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'groupId']);
    }

    public function beforeValidate()
    {        
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
        $this->uniqueCode = $this->location->uniqueCode . ((isset($this->documentType) && !empty($this->documentType)) ? '.' . $this->documentType : '') . ((isset($this->revisionNumber) && !empty($this->revisionNumber)) ? '.' . $this->revisionNumber : '');
    }

    // public function getUniqueCode() : string
    // {
    //     return $this->uniqueCode;
    // }

    public function getUniqueCode() : string
    {
        $group = $this->location;
        if(!isset($group)){
            $group = Location::findOne($this->groupId);
        }
        $categoryUniqueCodeWithoutDot = str_replace('.' , '', $group->category->uniqueCode);
        
        return $categoryUniqueCodeWithoutDot . '.' . $group->code . ((isset($this->documentType) && !empty($this->documentType)) ? '.' . $this->documentType : '') . ((isset($this->revisionNumber) && !empty($this->revisionNumber)) ? '.' . $this->revisionNumber : '');
    }    
}
