<?php

namespace nad\research\modules\source\models;

use yii\data\ActiveDataProvider;

class SourceSearch extends Source
{
    public function rules()
    {
        return [
            [['title', 'recommenderName'], 'string'],
            [['id', 'expertId', 'status'], 'integer']
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
                    'recommendationDate',
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
            'status' => $this->status
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        $query->andFilterWhere(['like', 'recommenderName', $this->recommenderName]);

        return $dataProvider;
    }
}
