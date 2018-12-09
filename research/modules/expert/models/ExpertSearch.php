<?php

namespace nad\research\modules\expert\models;

use yii\data\ActiveDataProvider;

class ExpertSearch extends Expert
{
    public function rules()
    {
        return [
            ['userId', 'integer']
        ];
    }

    public function search($params)
    {
        $query = Expert::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'id',
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

        $query->andFilterWhere(['userId' => $this->userId]);

        return $dataProvider;
    }
}
