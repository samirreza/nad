<?php

namespace nad\research\modules\source\models;

use yii\data\ActiveDataProvider;

class SourceSearch extends Source
{
    public function rules()
    {
        return [
            [['title', 'uniqueCode'], 'string'],
            [['id', 'createdBy', 'mainReasonId', 'status'], 'integer']
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
            'mainReasonId' => $this->mainReasonId,
            'status' => $this->status
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        $query->andFilterWhere(['like', 'uniqueCode', $this->uniqueCode]);

        return $dataProvider;
    }
}
