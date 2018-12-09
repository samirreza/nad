<?php

namespace nad\research\modules\project\models;

use yii\data\ActiveDataProvider;

class ProjectSearch extends Project
{
    public function rules()
    {
        return [
            ['title', 'string'],
            [['createdBy', 'status', 'proposalId'], 'integer']
        ];
    }

    public function search($params)
    {
        $query = Project::find();
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
            'proposalId' => $this->proposalId
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
