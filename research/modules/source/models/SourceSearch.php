<?php

namespace nad\research\modules\source\models;

use yii\data\ActiveDataProvider;

class SourceSearch extends Source
{
    public function rules()
    {
        return [
            ['title', 'string'],
            [['id', 'createdBy', 'status'], 'integer']
        ];
    }

    public function search($params)
    {
        $query = Source::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'id',
                    'createdAt',
                    'deliverToManagerDate',
                    'sessionDate',
                    'status'
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
            'id' => $this->id,
            'createdBy' => $this->createdBy,
            'status' => $this->status
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
