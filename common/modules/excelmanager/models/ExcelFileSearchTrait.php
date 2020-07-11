<?php
namespace nad\common\modules\excelmanager\models;

use Yii;
use yii\data\ActiveDataProvider;

trait ExcelFileSearchTrait
{
    public function attributes()
    {
        return parent::attributes();
    }

    public function rules()
    {
        return [
            [['title', 'uniqueCode'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = ExcelFile::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', 'uniqueCode', $this->uniqueCode]);

        return $dataProvider;
    }
}
