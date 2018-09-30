<?php

namespace modules\nad\equipment\modules\document\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class DocumentSearch extends Document
{
    public function rules()
    {
        return [
            [['documentId'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Document::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'createdAt' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'documentId' => $this->documentId,
            'typeId' => $params['typeId'],
        ]);

        return $dataProvider;
    }
}
