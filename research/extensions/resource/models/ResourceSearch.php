<?php

namespace nad\research\extensions\resource\models;

use yii\data\ActiveDataProvider;

class ResourceSearch extends Resource
{
    public function rules()
    {
        return [
            ['clientId', 'integer'],
            [['uniqueCode', 'title', 'type'], 'string']
        ];
    }

    public function search($params)
    {
        $query = Resource::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'createdAt'
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

        $query->andFilterWhere(['clientId' => $this->clientId]);

        $query->andFilterWhere(['like', 'uniqueCode', $this->uniqueCode]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        $query->andFilterWhere(['type' => $this->type]);

        return $dataProvider;
    }
}
