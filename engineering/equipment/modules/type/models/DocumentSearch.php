<?php

namespace nad\engineering\equipment\modules\type\models;

use yii\data\ActiveDataProvider;

class DocumentSearch extends Document
{
    public function rules()
    {
        return [
            ['equipmentTypeId', 'integer'],
            [['title', 'uniqueCode'], 'string']
        ];
    }

    public function search($params)
    {
        $query = Document::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'createdAt',
                    'updatedAt'
                ],
                'defaultOrder' => [
                    'createdAt' => SORT_DESC
                ]
            ]
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'equipmentTypeId' => $this->equipmentTypeId
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        $query->andFilterWhere(['like', 'uniqueCode', $this->uniqueCode]);

        return $dataProvider;
    }
}
