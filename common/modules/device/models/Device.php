<?php
namespace nad\common\modules\device\models;

use nad\rla\models\BaseAccessModel;
use nad\common\code\Codable;
use yii\helpers\ArrayHelper;
use nad\common\code\CodableTrait;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\common\modules\device\models\DocumentGroup;
use nad\common\modules\device\models\DevicePart;
use nad\common\modules\device\models\DeviceInstance;
use nad\common\modules\device\models\Category;
use extensions\auditTrail\behaviors\AuditTrailBehavior;

class Device extends BaseAccessModel implements Codable
{
    use CodableTrait;

    public static function tableName()
    {
        return 'nad_eng_device';
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
            ]
        );
    }

    public function rules()
    {
        return [
            [['categoryId', 'code'], 'required'],
            [['title', 'code'], 'trim'],
            [['title', 'code'], 'string', 'max' => 255],
            ['code', 'string', 'max' => 3, 'min' => 1],
            [['categoryId'], 'integer'],
            [['code', 'title'], FarsiCharactersValidator::className()],
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
            'code' => 'شناسه نوع',
            'uniqueCode' => 'شناسه یکتا',
            'title' => 'عنوان',
            'parts' => 'قطعات',
            'instances' => 'تعداد تجهیز',
            'categoryId' => 'رده پدر',
            'category.title' => 'عنوان رده',
            'category.familyTreeTitle' => 'عنوان کامل رده',
            'createdAt' => 'تاریخ درج',
            'updatedAt' => 'آخرین بروزرسانی'
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'categoryId']);
    }

    public function getParts()
    {
        return $this->hasMany(DevicePart::className(), ['deviceId' => 'id']);
    }

    public function getInstances()
    {
        return $this->hasMany(DeviceInstance::className(), ['deviceId' => 'id']);
    }

    public function getDocumentGroups()
    {
        return $this->hasMany(DocumentGroup::className(), ['deviceId' => 'id']);
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

    public function getUniqueCode() : string
    {
        return $this->uniqueCode;
    }

    public static function getAllCategories(){
        $categories = Category::find()
                ->orderBy(['code' => SORT_ASC])
                ->andWhere([
                    'depth' => 2
                    ])
                ->all();

        return ArrayHelper::map($categories, 'id', 'codedTitle');
    }
}
