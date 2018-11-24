<?php

namespace nad\research\modules\proposal\models;

use yii\data\ActiveDataProvider;

class ProposalSearch extends Proposal
{
    public function rules()
    {
        return [
            [['title', 'researcherName'], 'string'],
            [['id', 'expertId', 'status', 'sourceId'], 'integer']
        ];
    }

    public function search($params)
    {
        $query = Proposal::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'id',
                    'presentationDate',
                    'deliverToManagerDate',
                    'sessionDate',
                    'status'
                ],
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ]
        ]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'expertId' => $this->expertId,
            'status' => $this->status,
            'sourceId' => $this->sourceId
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        $query->andFilterWhere(['like', 'researcherName', $this->researcherName]);

        return $dataProvider;
    }
}
