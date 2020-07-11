<?php
namespace nad\common\modules\excelmanager\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use extensions\ExcelReader\ExcelReader;
use extensions\file\behaviors\FileBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;

class ExcelFile extends ActiveRecord
{

    public static function tableName()
    {
        return 'nad_excel_file';
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'core\behaviors\TimestampBehavior',
                [
                    'class' => FileBehavior::className(),
                    // 'customModelClassName' => static::CONSUMER_CODE,
                    'groups' => [
                        'file' => [
                            'type' => FileBehavior::TYPE_FILE,
                            'rules' => [
                                'extensions' => ['xls', 'xlsx', 'csv'],
                                'maxSize' => 5*1024*1024,
                                'required' => true
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
            [['title', 'uniqueCode'], 'required'],
            [['title', 'uniqueCode', 'description'], 'trim'],
            [['title'], 'string', 'max' => 512],
            [['uniqueCode'], 'string', 'max' => 255],
            [['description'], 'string'],
            ['fileData', 'safe'],
            [['title', 'uniqueCode', 'description'], FarsiCharactersValidator::className()],
            [
                'uniqueCode',
                'unique',
                'message' => 'این شناسه پیش تر ثبت شده است.'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'عنوان فایل',
            'uniqueCode' => 'شناسه فایل',
            'description' => 'توضیحات',
            'createdAt' => 'تاریخ درج',
            'updatedAt' => 'آخرین بروزرسانی',
            'fileData' => 'محتوای فایل'
        ];
    }

    public function beforeValidate()
    {
        $this->uniqueCode = strtoupper($this->uniqueCode);
        return parent::beforeValidate();
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

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $data = $this->getExcelData();
        $updateSql = "UPDATE {$this->tableName()} SET fileData = :fileData WHERE id = {$this->getPrimaryKey()}";
        Yii::$app->db->createCommand($updateSql)->bindValues([':fileData' => $data])->execute();
    }

    public function setUniqueCode()
    {
        $this->uniqueCode = $this->uniqueCode;
    }

    public function getUniqueCode() : string
    {
        return $this->uniqueCode;
    }

    public function getExcelData(){
        $data = [];
        $data['rows'] = ExcelReader::import(($this->getFiles('file')[0])->getPath());
        $jsonData = Json::encode($data);

        return $jsonData;
    }
}
