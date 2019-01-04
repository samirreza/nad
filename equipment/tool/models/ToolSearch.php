<?php

namespace nad\equipment\tool\models;

use yii\data\ActiveDataProvider;

class ToolSearch extends Tool
{
    public function attributes()
    {
        return array_merge(parent::attributes(), ['category.title']);
    }

    public function rules()
    {
        return [
            [['title', 'category.title', 'uniqueCode'], 'safe']
        ];
    }

    public function search($params)
    {
        $query = Tool::find()->joinWith('category AS category');
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'nad_eng_resource.title', $this->title]);

        $query->andFilterWhere(['like', 'uniqueCode', $this->uniqueCode]);

        $query->andFilterWhere(
            ['like', 'category.title', $this->getAttribute('category.title')]
        );

        return $dataProvider;
    }
}
