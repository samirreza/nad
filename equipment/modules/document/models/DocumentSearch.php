<?php

namespace modules\nad\equipment\modules\document\models;

use yii\data\ActiveDataProvider;

class DocumentSearch extends Document
{
    public function rules()
    {
        return [
            [['documentTypeId', 'equipmentTypeId'], 'integer']
        ];
    }

    public function search($params)
    {
        $query = Document::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ]
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'documentTypeId' => $this->documentTypeId,
            'equipmentTypeId' => $this->equipmentTypeId
        ]);

        return $dataProvider;
    }
}
