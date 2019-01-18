<?php

namespace nad\research\control\material\models;

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
            [
                ['title', 'code', 'titleEn', 'category.title', 'uniqueCode'],
                'string'
            ],
        ];
    }

    public function search($params)
    {
        $query = Type::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('category AS category');

        $query->andFilterWhere(['like', 'nad_material_type.title', $this->title]);

        $query->andFilterWhere(['like', 'code', $this->code]);

        $query->andFilterWhere(['like', 'titleEn', $this->titleEn]);

        $query->andFilterWhere(['like', 'uniqueCode', $this->uniqueCode]);

        $query->andFilterWhere(
            ['like', 'category.title', $this->getAttribute('category.title')]
        );

        return $dataProvider;
    }
}
