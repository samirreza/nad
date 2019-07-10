<?php
namespace nad\engineering\stage\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class StageSearch extends Stage
{
    public function attributes()
    {
        return array_merge(parent::attributes(), ['category.title', 'parent.title']);
    }

    public function rules()
    {
        return [
            [['title', 'category.title', 'parent.title', 'uniqueCode'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Stage::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith('category AS category');
        $query->joinWith('parent AS parent');
        $query->andFilterWhere(['like', 'nad_eng_stage.title', $this->title]);
        $query->andFilterWhere(['like', 'uniqueCode', $this->uniqueCode]);
        $query->andFilterWhere(
            ['like', 'category.title', $this->getAttribute('category.title')]
        );
        $query->andFilterWhere(
            ['like', 'parent.title', $this->getAttribute('parent.title')]
        );
        return $dataProvider;
    }
}
