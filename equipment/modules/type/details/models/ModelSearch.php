<?php

namespace modules\nad\equipment\modules\type\details\models;

use yii\data\ActiveDataProvider;

class ModelSearch extends Model
{
    public function rules()
    {
        return [
            [['title', 'code', 'partId', 'uniqueCode'], 'safe'],
            ['partId', 'integer'],
        ];
    }

    public function search($params)
    {
        $query = Model::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'partId' => SORT_ASC,
                    'code' => SORT_ASC
                ]
            ]
        ]);
        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([
            'typeId' => $params['typeId'],
            'partId' => $this->partId,
        ]);
        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'uniqueCode', $this->uniqueCode]);
        return $dataProvider;
    }
}
