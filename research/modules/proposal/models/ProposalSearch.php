<?php

namespace nad\research\modules\proposal\models;

use yii\data\ActiveDataProvider;

class ProposalSearch extends Proposal
{
    public function rules()
    {
        return [
            [
                [
                    'title',
                    'necessity',
                    'mainPurpose',
                    'secondaryPurpose',
                    'proceedings'
                ],
                'string'
            ],
            [['createdBy', 'status', 'sourceId', 'expertUserId'], 'integer'],
            [['tags', 'materials', 'equipments', 'equipmentParts'], 'safe']
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
            'sourceId' => $this->sourceId,
            'expertUserId' => $this->expertUserId
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        $query->andFilterWhere(['like', 'necessity', $this->necessity]);

        $query->andFilterWhere(['like', 'mainPurpose', $this->mainPurpose]);

        $query->andFilterWhere(['like', 'secondaryPurpose', $this->secondaryPurpose]);

        $query->andFilterWhere(['like', 'proceedings', $this->proceedings]);

        $query->hasAnyTags($this->tags);

        $query->hasAnyMaterials($this->materials);

        $query->hasAnyEquipments($this->equipments);

        $query->hasAnyEquipmentParts($this->equipmentParts);

        return $dataProvider;
    }
}
