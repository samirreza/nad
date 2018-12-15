<?php

namespace nad\research\modules\resource\models;

use yii\data\ActiveDataProvider;

class ResourceSearch extends Resource
{
    public function rules()
    {
        return [
            ['title', 'string']
        ];
    }

    public function search($params)
    {
        $query = Resource::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'createdAt',
                    'updatedAt'
                ],
                'defaultOrder' => [
                    'createdAt' => SORT_DESC
                ]
            ]
        ]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
