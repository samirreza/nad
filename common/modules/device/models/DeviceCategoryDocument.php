<?php
namespace nad\common\modules\device\models;

use Yii;
use nad\common\code\Codable;
use nad\common\code\CodableTrait;
use extensions\file\behaviors\FileBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\common\modules\device\models\Device;
use nad\common\modules\device\models\Category;
use extensions\auditTrail\behaviors\AuditTrailBehavior;

class DeviceCategoryDocument extends \yii\db\ActiveRecord implements Codable
{
    use CodableTrait;

    const LOOKUP_DOCUMENT_FORMAT = 'nad.device.categoryDocument.docFormat';
    // const LOOKUP_DOCUMENT_NAME = 'nad.device.DeviceCategoryDocument.docName';

    public static function tableName()
    {
        return 'nad_eng_device_category_document';
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
            [['format', 'title', 'categoryId'], 'required'],
            [['format', 'categoryId'], 'integer'],
            [['title'], 'trim'],
            [['title'], 'string', 'max' => 255],
            [['title'], FarsiCharactersValidator::className()],
        ];
    }

    public function attributeLabels()
    {
        return [
            'code' => 'شمارنده',
            'title' => 'نام مدرک',
            'uniqueCode' => 'شناسه مدرک',
            'format' => 'نوع مدرک',
            'categoryId' => 'شناسه رده',
            'createdAt' => 'تاریخ درج',
            'updatedAt' => 'آخرین بروزرسانی'
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'categoryId']);
    }

    public function beforeValidate()
    {
        return parent::beforeValidate();
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->code = Yii::$app->db->createCommand('SELECT NEXTVAL(seq_nedcd_counter)')->queryScalar();
            $this->consumer = static::CONSUMER_CODE;
        }
        $this->setUniqueCode();
        return parent::beforeSave($insert);
    }

    public function setUniqueCode()
    {
        $this->uniqueCode = $this->category->uniqueCode . '.D.' . $this->getFormatCode() . '.' . $this->code;
    }

    public function getUniqueCode() : string
    {
        return isset($this->uniqueCode)?$this->uniqueCode:'';
    }

    public function getFormatCode(){
        $codes = [
            1 => 'B', // Book
            2 => 'A', // Paper ??
        ];

        return $codes[$this->format];
    }
}
