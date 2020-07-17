<?php
namespace nad\common\modules\excelmanager\models;

use Yii;
use yii\helpers\Html;
use nad\rla\models\BaseAccessModel;
use yii\helpers\Json;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use extensions\excelReader\ExcelReader;
use yii\behaviors\BlameableBehavior;
use extensions\file\behaviors\FileBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;

class ExcelFile extends BaseAccessModel
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
                    'class' => BlameableBehavior::class,
                    'createdByAttribute' => 'createdBy',
                    'updatedByAttribute' => 'updatedBy'
                ],
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

    public function getRows($modelId){
        $selectSql = "select JSON_QUERY(fileData, '$.rows') as fileRows from " . ExcelFile::tableName() . ' where id = :id';
        $rowsRaw = Yii::$app->db->createCommand($selectSql)->bindValues([':id' => $modelId])->queryOne();

        $rows = Json::decode($rowsRaw['fileRows']);

        return isset($rows[0]) ? $rows : [];
    }

    public function getColumns($rows){
        $columns = [];
        if (isset($rows[0])) {
            $columnNames = array_keys($rows[0]);
            foreach ($columnNames as $name) {
                $tmp = [];
                $tmp['attribute'] = $name;

                $columns[] = $tmp;
            }
        }

        return $columns;
    }

    public function getArrayDataProvider($rows){
        $dataProvider = new ArrayDataProvider([
            'allModels' => $rows,
            // 'sort' => [
            //     'attributes' => ['id', 'username', 'email'],
            // ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $dataProvider;
    }

    public function convertToEditableCell($columns){
        $finalColumns = [];
        $rownum = 0;
        foreach ($columns as $column) {
            $column['value'] = function($model) use ($column){
                // dd($model);
                return '
                <input
                    class = "form-control"
                    type = "text"
                    data-name = "' . Html::encode($column['attribute']) . '"
                    style = "min-width:80px;direction:ltr"
                    readonly = "true"
                    ondblclick = "this.removeAttribute(\'readonly\')"
                    value = "' . $model[$column['attribute']] . '"
                />';
            };
            $column['format'] = 'raw';

            $finalColumns[] = $column;
            ++$rownum;
        }

        return $finalColumns;
    }
}
