<?php

namespace nad\common\modules\investigation\proposal\models;

use yii\data\ActiveDataProvider;

trait ProposalSearchTrait
{
    public function rules()
    {
        return [
            [['title', 'uniqueCode'], 'string'],
            [['createdBy', 'status'], 'integer']
        ];
    }

    public function search($params)
    {
        $query = parent::find();
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
            'createdBy' => $this->createdBy,
            'status' => $this->status
        ])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'uniqueCode', $this->uniqueCode]);

        return $dataProvider;
    }
}
