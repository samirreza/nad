<?php

namespace nad\research\modules\proposal\models;

use yii\data\ActiveDataProvider;

class ProposalSearch extends Proposal
{
    public function rules()
    {
        return [
            ['title', 'string'],
            [['createdBy', 'status', 'sourceId'], 'integer']
        ];
    }

    public function search($params)
    {
        $query = Proposal::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
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
            'createdBy' => $this->createdBy,
            'status' => $this->status,
            'sourceId' => $this->sourceId
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
