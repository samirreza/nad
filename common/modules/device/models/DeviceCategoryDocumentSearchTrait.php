<?php
namespace nad\common\modules\device\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

trait DeviceCategoryDocumentSearchTrait
{
    public function rules()
    {
        return [
            [['title', 'format', 'uniqueCode', 'categoryId'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Parent::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['=', 'categoryId', $this->categoryId]);
        $query->andFilterWhere(['=', 'format', $this->format]);
        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', 'uniqueCode', $this->uniqueCode]);
        return $dataProvider;
    }
}
