<?php
namespace nad\common\modules\device\models;

use Yii;
use nad\common\code\Codable;
use nad\common\code\CodableTrait;
use extensions\file\behaviors\FileBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use extensions\auditTrail\behaviors\AuditTrailBehavior;

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
                    ]
                ]
            ]
        );
    }

    public function rules()
    {
        return [
            [['title', 'instanceId'], 'required'],
            [['instanceId'], 'integer'],
            [['title'], 'trim'],
            [['title'], 'string', 'max' => 255],
            [['title'], FarsiCharactersValidator::className()],
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
        if ($insert) {
            $this->code = Yii::$app->db->createCommand('SELECT NEXTVAL(seq_nedpid_counter)')->queryScalar();
            $this->consumer = static::CONSUMER_CODE;
        }
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
