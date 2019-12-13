<?php
namespace nad\common\modules\device\models;

use nad\common\code\Codable;
use nad\common\code\CodableTrait;
use extensions\file\behaviors\FileBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;

class DevicePartInstanceDocument extends \yii\db\ActiveRecord implements Codable
{
    use CodableTrait;

    public static function tableName()
    {
        return 'nad_eng_device_part_instance_document';
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
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
                    ]
                ]
            ]
        );
    }

    public function rules()
    {
        return [
            [['title', 'instanceId', 'code'], 'required'],
            [['instanceId'], 'integer'],
            [['code', 'title'], 'trim'],
            [['code', 'title'], 'string', 'max' => 255],
            ['code', 'string', 'max' => 1, 'min' => 1],
            [['code', 'title'], FarsiCharactersValidator::className()],
            [
                'code',
                'unique',
                'targetAttribute' => ['code', 'instanceId'],
                'message' => 'این شناسه پیش تر ثبت شده است.'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'code' => 'شمارنده',
            'title' => 'عنوان مدرک',
            'uniqueCode' => 'شناسه یکتا',
            'instanceId' => 'شناسه قطعه',
            'createdAt' => 'تاریخ درج',
            'updatedAt' => 'آخرین بروزرسانی'
        ];
    }

    public function getInstance()
    {
        return $this->hasOne(PartInstance::className(), ['id' => 'instanceId']);
    }

    public function beforeValidate()
    {
        return parent::beforeValidate();
    }

    public function beforeSave($insert)
    {
        // dd($this->instanceId);
        // if ($insert) {
        //     $this->consumer = static::CONSUMER_CODE;
        // }
        $this->setUniqueCode();
        return parent::beforeSave($insert);
    }

    public function setUniqueCode()
    {
        $this->uniqueCode = $this->instance->uniqueCode . '.D.' . $this->code;
    }

    public function getUniqueCode() : string
    {
        return isset($this->uniqueCode)?$this->uniqueCode:'';
    }
}
