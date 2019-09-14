<?php

namespace nad\research\control\material\models;

use yii\data\ActiveDataProvider;

class CategorySearch extends Category
{
    public function rules()
    {
        return [
            [['title', 'code', 'depth'], 'safe']
        ];
    }

    public function search($params)
    {
        $query = Category::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'tree' => SORT_DESC,
                    'lft' => SORT_ASC
                ]
            ]
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'code' => $this->code,
            'depth' => $this->depth,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
