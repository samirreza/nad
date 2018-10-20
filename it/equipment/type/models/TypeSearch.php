<?php
namespace nad\it\equipment\type\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class TypeSearch extends Type
{
    public function attributes()
    {
        return array_merge(parent::attributes(), ['category.title']);
    }

    public function rules()
    {
        return [
            [['title', 'category.title', 'uniqueCode'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Type::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith('category AS category');
        $query->andFilterWhere(['like', 'nad_material_type.title', $this->title]);
        $query->andFilterWhere(['like', 'uniqueCode', $this->uniqueCode]);
        $query->andFilterWhere(
            ['like', 'category.title', $this->getAttribute('category.title')]
        );
        return $dataProvider;
    }
}
