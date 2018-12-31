<?php

namespace nad\office\modules\expert\models;

use yii\data\ActiveDataProvider;

class ExpertSearch extends Expert
{
    public function rules()
    {
        return [
            [['userId', 'departmentId'], 'integer']
        ];
    }

    public function search($params)
    {
        $query = Expert::find();
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

        $query->andFilterWhere([
            'userId' => $this->userId,
            'departmentId' => $this->departmentId
        ]);

        return $dataProvider;
    }
}
