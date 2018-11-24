<?php

namespace nad\research\modules\project\models;

use yii\data\ActiveDataProvider;

class ProjectSearch extends Project
{
    public function rules()
    {
        return [
            [['title', 'researcherName'], 'string'],
            [['id', 'status', 'proposalId'], 'integer']
        ];
    }

    public function search($params)
    {
        $query = Project::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'id',
                    'complationDate',
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
            'status' => $this->status,
            'proposalId' => $this->proposalId
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        $query->andFilterWhere(['like', 'researcherName', $this->researcherName]);

        return $dataProvider;
    }
}
