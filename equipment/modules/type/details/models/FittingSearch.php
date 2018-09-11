<?php

namespace modules\nad\equipment\modules\type\details\models;

use yii\data\ActiveDataProvider;

class FittingSearch extends Fitting
{
    public function rules()
    {
        return [
            [['title', 'code', 'uniqueCode'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Fitting::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC]
            ]
        ]);
        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere(['typeId' => $params['typeId']]);
        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'uniqueCode', $this->uniqueCode]);
        return $dataProvider;
    }
}
