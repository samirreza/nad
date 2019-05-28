<?php

namespace nad\common\modules\investigation\source\models;

use yii\data\ActiveDataProvider;

trait SourceSearchTrait
{
    public function rules()
    {
        return [
            [['title', 'uniqueCode'], 'string'],
            [['createdBy', 'mainReasonId', 'status'], 'integer']
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
            'mainReasonId' => $this->mainReasonId,
            'status' => $this->status
        ])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'uniqueCode', $this->uniqueCode]);

        return $dataProvider;
    }
}
