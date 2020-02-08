<?php
namespace nad\common\modules\device\models;

use nad\common\code\Codable;
use nad\common\code\CodableTrait;
use nad\common\helpers\Lookup;
use extensions\file\behaviors\FileBehavior;
use extensions\auditTrail\behaviors\AuditTrailBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\common\modules\device\models\DocumentGroup;
use nad\common\modules\investigation\common\behaviors\CodeNumeratorBehavior;

class DocumentGroupDocument extends \yii\db\ActiveRecord implements Codable
{
    use CodableTrait;

    const LOOKUP_DOCUMENT_TYPE = 'nad.device.DocumentGroupDocument.Type';

    public static function tableName()
    {
        return 'nad_eng_device_document_group_document';
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'codeNumerator' => [
                    'class' => CodeNumeratorBehavior::class,
                    'determinativeColumn' => 'groupId',
                    'lastCodeNumberColumn' => 'revisionNumber'
                ],
                [
                    'class' => AuditTrailBehavior::class,
                    'relations' => []
                ],
                'core\behaviors\TimestampBehavior',
                [
                    'class' => FileBehavior::className(),
                    'customModelClassName' => static::CONSUMER_CODE,
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
            'documentGroup.title' => 'عنوان گروه مدارک',
            'createdAt' => 'تاریخ درج',
            'updatedAt' => 'آخرین بروزرسانی'
        ];
    }

    public function getDocumentGroup()
    {
        return $this->hasOne(DocumentGroup::className(), ['id' => 'groupId']);
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
        $this->uniqueCode = $this->documentGroup->uniqueCode . ((isset($this->documentType) && !empty($this->documentType)) ? '.' . Lookup::extra('nad.device.DocumentGroupDocument.Type', $this->documentType) : '') . ((isset($this->revisionNumber) && !empty($this->revisionNumber)) ? '.' . $this->revisionNumber : '');
    }

    // public function getUniqueCode() : string
    // {
    //     return $this->uniqueCode;
    // }

    public function getUniqueCode() : string
    {
        $group = $this->documentGroup;
        if(!isset($group)){
            $group = DocumentGroup::findOne($this->groupId);
        }

        return $group->uniqueCode . ((isset($this->documentType) && !empty($this->documentType)) ? '.' . Lookup::extra('nad.device.DocumentGroupDocument.Type', $this->documentType) : '') . ((isset($this->revisionNumber) && !empty($this->revisionNumber)) ? '.' . $this->revisionNumber : '');
    }
}
